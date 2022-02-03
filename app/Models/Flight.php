<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'code',
        'type',
        'departure_id',
        'destination_id',
        'departure_time',
        'arrival_time',
    ];

    protected $dates = [
        'departure_time',
        'arrival_time',
        'created_at',
        'updated_at',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function departure()
    {
        return $this->belongsTo(Airport::class);
    }

    public function destination()
    {
        return $this->belongsTo(Airport::class);
    }

    public function remarks()
    {
        return $this->morphMany(Remark::class, 'remarkable');
    }
}
