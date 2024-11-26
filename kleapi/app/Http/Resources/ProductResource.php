<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id' => $this -> id,
            'product_name' => $this -> product_name,
            'description' => $this -> description,
            'product_price' => $this -> product_price,
            'created_at' => $this -> created_at,
        ];
    }
}
