<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnumRule implements Rule
{
    protected $enumClass;

    public function __construct($enumClass)
    {
        $this->enumClass = $enumClass;
    }

    public function passes($attribute, $value)
    {
        return in_array($value, $this->enumClass::getValues());
    }

    public function message()
    {
        return 'The :attribute must be a valid value.';
    }
}