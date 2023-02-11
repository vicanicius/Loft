<?php

namespace App\Repositories;

use App\Models\OccupationAttributes;
use Illuminate\Support\Facades\DB;

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
