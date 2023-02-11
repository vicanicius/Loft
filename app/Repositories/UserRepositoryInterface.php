<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface UserRepositoryInterface {

    public function create(Request $request);
    public function allUsers();
    public function getUser(int $userId);
    public function getAttributesByUserId(int $userId);
}