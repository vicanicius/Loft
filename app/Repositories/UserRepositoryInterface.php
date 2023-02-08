<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface UserRepositoryInterface {

    public function store(Request $request);
}