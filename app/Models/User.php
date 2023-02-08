<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'id',
        'name',
        'occupation_attributes_id'
    ];

    public function occupationAttributes()
    {
        return $this->hasOne(OccupationAttributes::class, 'id', 'occupation_attributes_id');
    }
}
