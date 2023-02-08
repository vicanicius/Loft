<?php

namespace App\Helpers;

use App\Enums\OccupationEnums;

function getWarriorAttributes()
{
    $baseAttributes = [
        "name" => OccupationEnums::WARRIOR,
        "life" => 20,
        "strength" => 10,
        "dexterity" => 5,
        "intelligence" => 5
    ];

    $battleModifiers = [
        'attack' => (80/100) * $baseAttributes['strength'] + (20/100) * $baseAttributes['dexterity'],
        'speed' => (60/100) * $baseAttributes['dexterity'] + (20/100) *  $baseAttributes['intelligence']
    ];    

    return array_merge($baseAttributes, $battleModifiers);
}

function getThiefAttributes()
{
    $baseAttributes = [
        "name" => OccupationEnums::THIEF,
        "life" => 15,
        "strength" => 4,
        "dexterity" => 10,
        "intelligence" => 4
    ];

    $battleModifiers = [
        'attack' => (25/100) * $baseAttributes['strength'] + (100/100) * $baseAttributes['dexterity'] + (25/100) * $baseAttributes['intelligence'],
        'speed' => (80/100) * $baseAttributes['dexterity']
    ];    

    return array_merge($baseAttributes, $battleModifiers);
}

function getMageAttributes()
{
    $baseAttributes = [
        "name" => OccupationEnums::MAGE,
        "life" => 12,
        "strength" => 5,
        "dexterity" => 6,
        "intelligence" => 10
    ];

    $battleModifiers = [
        'attack' => (20/100) * $baseAttributes['strength'] + (50/100) * $baseAttributes['dexterity'] + (150/100) * $baseAttributes['intelligence'],
        'speed' => (20/100) * $baseAttributes['strength'] + (50/100) *  $baseAttributes['dexterity']
    ];    

    return array_merge($baseAttributes, $battleModifiers);
}