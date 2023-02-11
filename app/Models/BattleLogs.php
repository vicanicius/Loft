<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleLogs extends Model
{
    use HasFactory;

    protected $table = 'battle_logs';

    protected $fillable = [
        'id',
        'log',
        'identifier'
    ];
}
