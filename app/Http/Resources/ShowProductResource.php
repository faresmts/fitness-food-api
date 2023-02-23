<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'code' => $this->code,
            'status' => $this->status,
            'imported_t' => $this->imported_t,
            'url' => $this->url,
            'creator' => $this->creator,
            'created_t' => $this->created_t,
            'last_modified_t' => $this->last_modified_t,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'brands' => $this->brands,
            'categories' => $this->categories,
            'labels' => $this->labels,
            'cities' => $this->cities,
            'purchase_places' => $this->purchase_places,
            'stores' => $this->stores,
            'ingredients_text' => $this->ingredients_text,
            'traces' => $this->traces,
            'serving_size' => $this->serving_size,
            'serving_quantity' => $this->serving_quantity,
            'nutriscore_score' => $this->nutriscore_score,
            'nutriscore_grade' => $this->nutriscore_grade,
            'main_category' => $this->main_category,
            'image_url' => $this->image_url,
        ];
    }
}
