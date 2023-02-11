<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface BattleRepositoryInterface {

    public function battle(object $userCalculatedSpeed1, object $userCalculatedSpeed2);
}