<?php

namespace App\UseCases;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        return $this->userRepository->store($request);
    }
}