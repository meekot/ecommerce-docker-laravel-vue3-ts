<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
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
            'title' => $this->title,
            'imageUrl' => $this->getImageUrl(),
            'price' => $this->price,
            'createdAt' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updatedAt' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
