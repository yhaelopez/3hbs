<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'city'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

}
