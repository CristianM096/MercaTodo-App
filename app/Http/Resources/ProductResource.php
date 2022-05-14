<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'photo' => $this->photo,
            'description' => $this->description,
            'stock' => $this->stock,
            'color' => $this->color,
            'weight' => $this->weight,
            'size' => $this->size,
            'active' => $this->active,
            'category_id' => $this->category_id,
        ];
    }
}
