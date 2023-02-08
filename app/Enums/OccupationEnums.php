<?php

namespace App\Enums;

class OccupationEnums
{
    const WARRIOR = 'warrior';
    const THIEF = 'thief';
    const MAGE = 'mage';

    public static function getValues()
    {
        return [
            self::WARRIOR,
            self::THIEF,
            self::MAGE
        ];
    }
}