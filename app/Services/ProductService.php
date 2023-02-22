<?php

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;

class ProductService
{
    public function saveProductsFromArray(array $jsons): void
    {
        foreach ($jsons as $data) {
            $product = new Product();
            $product->code = isset($data->code) ? $this->sanitizeCode($data->code) : null;
            $product->status = Product::STATUS['DRAFT'];
            $product->imported_t = Carbon::now()->toDateTimeString();
            $product->url = $data->url ?? null;
            $product->creator = $data->creator ?? null;
            $product->created_t = $data->created_t ?? null;
            $product->last_modified_t = $data->last_modified_t ?? null;
            $product->product_name = $data->product_name ?? null;
            $product->quantity = $data->quantity ?? null;
            $product->brands = $data->brands ?? null;
            $product->categories = $data->categories ?? null;
            $product->labels = $data->labels ?? null;
            $product->cities = $data->cities ?? null;
            $product->purchase_places = $data->purchase_places ?? null;
            $product->stores = $data->stores ?? null;
            $product->ingredients_text = $data->ingredients_text ?? null;
            $product->traces = $data->traces ?? null;
            $product->serving_size = $data->serving_size ?? null;
            $product->serving_quantity = isset($data->serving_quantity) ? $this->sanitizeServingQuantity(floatval($data->serving_quantity)) : null;
            $product->nutriscore_score = isset($data->nutriscore_score) ? intval($data->nutriscore_score) : null;
            $product->nutriscore_grade = $data->nutriscore_grade === '' ? '?' : $data->nutriscore_grade;
            $product->main_category = $data->main_category ?? null;
            $product->image_url = $data->image_url ?? null;

            $product->save();
        }
    }

    private function sanitizeCode(string $code): string
    {
        return str_replace('"', '', $code);
    }

    private function sanitizeServingQuantity(float $serving_quantity): float|null
    {
        if ($serving_quantity !== 0.0) {
            return $serving_quantity;
        }

        return null;
    }
}
