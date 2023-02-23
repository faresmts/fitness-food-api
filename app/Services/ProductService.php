<?php

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function saveProductsFromArray(array $jsons): void
    {
        foreach ($jsons as $data) {
            $product = new Product();
            $product->code = isset($data->code) ? intval($this->sanitizeCode($data->code)) : null;
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

    public function showAllProducts(Request $request): LengthAwarePaginator
    {
        $perPage = $request->query('per_page', 10);

        return Product::query()
            ->select()
            ->paginate($perPage);
    }

    public function showProduct(int $productCode): ?Product
    {
        return Product::where('code', $productCode)
            ->where('status', '!=', Product::STATUS['TRASH'])
            ->first();
    }

    public function updateProduct(array $data, int $productCode): Product
    {
        /**
         * @var Product $product
         */
        $product = Product::where('code', $productCode)->first();

        $product->code = $data['code'] ?? $product->code;
        $product->status = $data['status'] ?? $product->status;
        $product->url = $data['url'] ?? $product->url;
        $product->creator = $data['creator'] ?? $product->creator;
        $product->created_t = $data['created_t'] ?? $product->created_t;
        $product->last_modified_t = $data['last_modified_t'] ?? $product->last_modified_t;
        $product->product_name = $data['product_name'] ?? $product->product_name;
        $product->quantity = $data['quantity'] ?? $product->quantity;
        $product->brands = $data['brands'] ?? $product->brands;
        $product->categories = $data['categories'] ?? $product->categories;
        $product->labels = $data['labels'] ?? $product->labels;
        $product->purchase_places = $data['purchase_places'] ?? $product->purchase_places;
        $product->stores = $data['stores'] ?? $product->stores;
        $product->ingredients_text = $data['ingredients_text'] ?? $product->code;
        $product->traces = $data['traces'] ?? $product->traces;
        $product->serving_size = $data['serving_size'] ?? $product->serving_size;
        $product->serving_quantity = $data['serving_quantity'] ?? $product->serving_quantity;
        $product->nutriscore_score = $data['nutriscore_score'] ?? $product->nutriscore_score;
        $product->nutriscore_grade = $data['nutriscore_grade'] ?? $product->nutriscore_grade;
        $product->main_category = $data['main_category'] ?? $product->main_category;
        $product->image_url = $data['image_url'] ?? $product->image_url;

        $product->save();
        $product->refresh();

        return $product;
    }

    public function deleteProduct(int $productCode): void
    {
        /**
         * @var Product $product
         */
        $product = Product::where('code', '=', $productCode)->first();
        $product->status = Product::STATUS['TRASH'];
        $product->save();
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
