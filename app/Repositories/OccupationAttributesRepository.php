<?php

namespace App\Repositories;

use App\Models\OccupationAttributes;
use Illuminate\Support\Facades\DB;

class OccupationAttributesRepository implements OccupationAttributesRepositoryInterface
{
    public function getIdByName($name)
    {
        $occupationAttributes = OccupationAttributes::firstWhere([
            'name' =>  $name
        ]);

        return $occupationAttributes->getKey();
    }
}
