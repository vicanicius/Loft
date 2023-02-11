<?php

namespace App\UseCases;

use App\Repositories\BattleRepository;
use App\Repositories\UserRepository;

class BattleUseCase
{
    public function __construct(
        private BattleRepository $battleRepository,
        private UserRepository $userRepository
    ) {
        $this->battleRepository = $battleRepository;
        $this->userRepository = $userRepository;
    }

    public function battle($userId1, $userId2)
    {
        $users = $this->prepareDataForBattle($userId1, $userId2);
        
        return $this->battleRepository->battle($users['userCalculatedSpeed1'], $users['userCalculatedSpeed2']);
    }

    private function prepareDataForBattle($userId1, $userId2)
    {
        $attributesUser1 =  $this->userRepository->getAttributesByUserId($userId1);
        $attributesUser2 = $this->userRepository->getAttributesByUserId($userId2);

        $userCalculatedSpeed1 = $this->randSpeed($attributesUser1);
        $userCalculatedSpeed2 = $this->randSpeed($attributesUser2);

        while ($userCalculatedSpeed1->speed == $userCalculatedSpeed2->speed) {
            $userCalculatedSpeed1 = $this->randSpeed($attributesUser1);
            $userCalculatedSpeed2 = $this->randSpeed($attributesUser2);
        } 

        return [
            'userCalculatedSpeed1' => $userCalculatedSpeed1, 
            'userCalculatedSpeed2' => $userCalculatedSpeed2
        ];
    }

    private function randSpeed($value)
    {
        $value->speed = rand(0, $value->speed);
        return $value;
    }
}