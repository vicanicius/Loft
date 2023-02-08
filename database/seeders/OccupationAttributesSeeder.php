<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function App\Helpers\getMageAttributes;
use function App\Helpers\getThiefAttributes;
use function App\Helpers\getWarriorAttributes;

class OccupationAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupation_attributes')->insert([
            getWarriorAttributes()
        ]);

        DB::table('occupation_attributes')->insert([
            getThiefAttributes()
        ]);

        DB::table('occupation_attributes')->insert([
            getMageAttributes()
        ]);
    }
}
