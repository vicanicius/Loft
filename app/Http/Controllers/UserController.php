<?php

namespace App\Http\Controllers;

use App\UseCases\UserUseCase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserUseCase $userUseCase) {
        $this->userUseCase = $userUseCase;
    }

    public function create(Request $request)
    {        
        return response($this->userUseCase->create($request));
    }

    public function allUsers()
    {        
        return response($this->userUseCase->allUsers());
    }

    public function getUser($userId)
    {        
        return response($this->userUseCase->getUserById($userId));
    }
}
