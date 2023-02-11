<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Exceptions\StandardException;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private OccupationAttributesRepository $occupationAttributesRepository) {
        $this->occupationAttributesRepository = $occupationAttributesRepository;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        $occupation = $this->occupationAttributesRepository->getByName($request->occupation);

        try {
            $user = User::create([
                'name' =>  $request->name,
                'occupation_attributes_id' => $occupation->getKey(),
                'life_points' => $occupation->life,
            ]);
    
            DB::commit();
            return $user->load('occupationAttributes');
        } catch (Exception $ex) {
            DB::rollBack();
            throw new StandardException("Não foi possivel criar seu personagem");
        }
    }

    public function allUsers()
    {
        return DB::table('users')
        ->join('occupation_attributes', 'users.occupation_attributes_id', '=', 'occupation_attributes.id')
        ->selectRaw('users.id,
            users.name, 
            occupation_attributes.name as occupation, 
            case when users.life_points > 0 then "Alive" else "Dead" end as status'
        )
        ->get();
    }

    public function getUser(int $userId)
    {
        $user = User::find($userId);

        if (is_null($user)) {
            throw new NotFoundException("Personagem não encontrado");
        }

        return $user->load('occupationAttributes');
    }

    public function getAttributesByUserId(int $userId)
    {
        $user = DB::table('users')
        ->join('occupation_attributes', 'users.occupation_attributes_id', '=', 'occupation_attributes.id')
        ->where('users.id', $userId)
        ->select('occupation_attributes.*', 'users.name as char_name', 'users.id as user_id')
        ->first();

        if (is_null($user)) {
            throw new NotFoundException("Um ou mais personagens não foram encontrados");
        }

        return $user;
    }
}
