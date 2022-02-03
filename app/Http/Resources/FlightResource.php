<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => 'flights',
            'id' => $this->id,
            'attributes' => [
                'airline_id' => $this->airline_id,
                'code' => $this->code,
                'type' => $this->type,
                'departure_id' => $this->departure_id,
                'destination_id' => $this->destination_id,
                'departure_time' => $this->departure_time->format('Y-m-d H:i:s'),
                'arrival_time' => $this->arrival_time->format('Y-m-d H:i:s'),
            ],
            'links' => [
                'self' => route('api.v1.flights.show', ['flight' => $this])
            ]
        ];
    }
}
