<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccupationAttributes extends Model
{
    use HasFactory;

    protected $table = 'occupation_attributes';

    protected $fillable = [
        'id',
        'name',
        'life',
        'strength',
        'dexterity',
        'intelligence',
        'attack',
        'speed',
    ];
}
