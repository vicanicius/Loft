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

    protected $appends = ['attack_description', 'speed_description'];

    public function getAttackDescriptionAttribute()
    {
        switch ($this->name) {
            case 'warrior':
                return '80% da Força + 20% da Destreza';
                break;
            case 'thief':
                return '25% da Força + 100% da Destreza + 25% da Inteligência';
                break;
            case 'mage':
                return '20% da Força + 50% da Destreza + 150% da Inteligência';
                break;
        }
    }

    public function getSpeedDescriptionAttribute()
    {
        switch ($this->name) {
            case 'warrior':
                return '60% da Destreza + 20% da Inteligência';
                break;
            case 'thief':
                return '80% da Destrezaa';
                break;
            case 'mage':
                return '20% da Força + 50% da Destreza';
                break;
        }
    }
}
