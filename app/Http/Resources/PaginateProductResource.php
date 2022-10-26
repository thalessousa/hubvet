<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginateProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'store' => new StoreResource($this->whenLoaded('store')),
            'sector' => new SectorResource($this->whenLoaded('sector')),
        ];
    }
}