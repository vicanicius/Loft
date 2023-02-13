<?php

namespace App\Repositories;

use App\Models\OccupationAttributes;

class OccupationAttributesRepository implements OccupationAttributesRepositoryInterface
{
    public function getByName($name)
    {
        $occupationAttributes = OccupationAttributes::firstWhere([
            'name' =>  $name
        ]);

        return $occupationAttributes;
    }
}