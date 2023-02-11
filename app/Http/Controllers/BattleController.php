<?php

namespace App\Http\Controllers;

use App\UseCases\BattleUseCase;
use Illuminate\Http\Request;

class BattleController extends Controller
{
    public function __construct(private BattleUseCase $battleUseCase) {
        $this->battleUseCase = $battleUseCase;
    }

    public function battle(int $userId1, int $userId2)
    {
        return response($this->battleUseCase->battle($userId1, $userId2));
    }
}
