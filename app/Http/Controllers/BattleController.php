<?php

namespace App\Http\Controllers;

use App\UseCases\BattleUseCase;

class BattleController extends Controller
{
    public function __construct(private BattleUseCase $battleUseCase) {
        $this->battleUseCase = $battleUseCase;
    }

    public function battle(int $userId1, int $userId2)
    {
        return response()->json($this->battleUseCase->battle($userId1, $userId2));
    }
}
