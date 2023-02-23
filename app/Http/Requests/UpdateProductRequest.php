<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'code' => ['numeric', 'nullable'] ,
            'status' => ['in:trash,draft,published', 'nullable'],
            'url' => ['string', 'nullable', 'url'],
            'creator' => ['string', 'nullable'],
            'created_t' => ['string', 'nullable'],
            'last_modified_t' => ['string', 'nullable'],
            'product_name' => ['string', 'nullable'],
            'quantity' => ['string', 'nullable'],
            'brands' => ['string', 'nullable'],
            'categories' => ['string', 'nullable'],
            'labels' => ['string', 'nullable'],
            'cities' => ['string', 'nullable'],
            'purchase_places' => ['string', 'nullable'],
            'stores' => ['string', 'nullable'],
            'ingredients_text' => ['string', 'nullable'],
            'traces' => ['string', 'nullable'],
            'serving_size' => ['string', 'nullable'],
            'serving_quantity' => ['numeric', 'nullable'],
            'nutriscore_score' => ['numeric', 'nullable', 'between:-15,40'],
            'nutriscore_grade' => ['string', 'nullable', 'max:1'],
            'main_category' => ['string', 'nullable'],
            'image_url' => ['string', 'nullable', 'url'],
        ];
    }
}
