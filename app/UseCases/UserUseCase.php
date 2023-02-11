<?php

namespace App\UseCases;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function create(Request $request)
    {
        return $this->userRepository->create($request);
    }

    public function allUsers()
    {
        return $this->userRepository->allUsers();
    }

    public function getUserById(int $userId)
    {
        return $this->userRepository->getUser($userId);
    }
}