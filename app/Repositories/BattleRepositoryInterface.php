<?php

namespace App\Repositories;

interface BattleRepositoryInterface {

    public function battle(object $userCalculatedSpeed1, object $userCalculatedSpeed2);
}