<?php

namespace App\Repositories;

use App\Exceptions\StandardException;
use App\Models\BattleLogs;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BattleRepository implements BattleRepositoryInterface
{
    public function battle(object $userCalculatedSpeed1, object $userCalculatedSpeed2)
    {
        return $this->battleLog($userCalculatedSpeed1, $userCalculatedSpeed2);
    }

    private function battleLog($userCalculatedSpeed1, $userCalculatedSpeed2)
    {
        DB::beginTransaction();
        try {
            if ($userCalculatedSpeed1->speed > $userCalculatedSpeed2->speed) {
                $battleLogs = BattleLogs::create([
                    'log' => "$userCalculatedSpeed1->char_name ($userCalculatedSpeed1->speed) foi mais veloz que o $userCalculatedSpeed2->char_name ($userCalculatedSpeed2->speed), e irá começar!",
                    'identifier' => (string) Str::uuid()
                ]);

                $this->execBattle($userCalculatedSpeed1, $userCalculatedSpeed2, $battleLogs);

                DB::commit();
                return BattleLogs::where('identifier', $battleLogs->identifier)->get();
            }

            $battleLogs = BattleLogs::create([
                'log' => "$userCalculatedSpeed2->char_name ($userCalculatedSpeed2->speed) foi mais veloz que o $userCalculatedSpeed1->char_name ($userCalculatedSpeed1->speed), e irá começar!",
                'identifier' => (string) Str::uuid()
            ]);

            $this->execBattle($userCalculatedSpeed2, $userCalculatedSpeed1, $battleLogs);

            DB::commit();
            return BattleLogs::where('identifier', $battleLogs->identifier)->get();
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
            throw new StandardException("Não foi possivel a batalha de seus personagens.");
        }
    }

    private function execBattle($userFirstAttack, $userSecondAttack, $battleLogs)
    {
        $firstUserToSuffer = User::find($userSecondAttack->user_id);
        $secondUserToSuffer = User::find($userFirstAttack->user_id);

        $stop = false;
        while (
            (!$stop)
        ) {
            $firstCalculatedAttack = rand(0, $userFirstAttack->attack);

            $newLifePoints = $firstUserToSuffer->life_points - $firstCalculatedAttack;
            $firstUserToSuffer->update(['life_points' => max(0, $newLifePoints)]);
            
            $this->saveLog($userFirstAttack, $firstCalculatedAttack, $firstUserToSuffer, $battleLogs);
            
            if ($newLifePoints <= 0) {
                $stop = true;
                $this->endGame($secondUserToSuffer, $battleLogs);
                break;
            }

            $secondCalculatedAttack = rand(0, $userSecondAttack->attack);

            $newLifePoints = $secondUserToSuffer->life_points - $secondCalculatedAttack;
            $secondUserToSuffer->update(['life_points' => max(0, $newLifePoints)]);
            $this->saveLog($userSecondAttack, $secondCalculatedAttack, $secondUserToSuffer, $battleLogs);

            if ($newLifePoints <= 0) {
                $stop = true;
                $this->endGame($firstUserToSuffer, $battleLogs);
                break;
            }
        }
    }
    
    private function saveLog($userAttack, $calculatedAttack, $userDefense, $battleLogs)
    {
        BattleLogs::create([
            'log' => $this->getMessageToLog($userAttack, $calculatedAttack, $userDefense),
            'identifier' => $battleLogs->identifier
        ]);
    }

    private function getMessageToLog($userAttack, $calculatedAttack, $userDefense)
    {
        if ($userDefense->life_points > 0) {
            return "$userAttack->char_name atacou com $calculatedAttack de dano, $userDefense->name com $userDefense->life_points pontos de vida restantes;";
        }
        return "$userAttack->char_name atacou com $calculatedAttack de dano, $userDefense->name com 0 pontos de vida restantes;";
    }

    private function endGame($winUser, $battleLogs)
    {
        BattleLogs::create([
            'log' => "$winUser->name venceu a batalha! $winUser->name ainda tem $winUser->life_points pontos de vida restantes!",
            'identifier' => $battleLogs->identifier
        ]);
    }
}
