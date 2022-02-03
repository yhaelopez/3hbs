<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RemarkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => 'remarks',
            'id' => $this->id,
            'attributes' => [
                'remarkable_id' => $this->remarkable_id,
                'remarkable_type' => $this->remarkable_type,
                'comment' => $this->comment,
            ],
            'links' => [
                'self' => route('api.v1.remarks.show', ['remark' => $this])
            ]
        ];
    }
}
