<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class StandardException extends Exception
{
    public function __construct($message, $code = Response::HTTP_BAD_REQUEST, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}