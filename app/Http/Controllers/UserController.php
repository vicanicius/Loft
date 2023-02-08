<?php

namespace App\Http\Controllers;

use App\UseCases\UserUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(private UserUseCase $userUseCase) {
        $this->userUseCase = $userUseCase;
    }

    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z_]{4,15}$/',
            'occupation' => 'exists:occupation_attributes,name'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $errors[] = $message;
            }

            return response()->json(["messages" => $errors]);
        }

        return response($this->userUseCase->store($request));
    } 
}
