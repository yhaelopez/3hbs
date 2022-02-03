<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AirlineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => 'airlines',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'code' => $this->code,
            ],
            'links' => [
                'self' => route('api.v1.airlines.show', $this)
            ]
        ];
    }
}
