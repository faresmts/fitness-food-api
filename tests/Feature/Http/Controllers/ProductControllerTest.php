<?php

use App\Models\Product;

it('behaves as expected when getting specific product data', function () {
    $product = Product::factory()->create();

    $response = $this->get(route('products.show', [
        'product' => $product->code
    ]));

    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'code',
            'status',
            'imported_t',
            'url',
            'creator',
            'created_t',
            'last_modified_t',
            'product_name',
            'quantity',
            'brands',
            'categories',
            'labels',
            'cities',
            'purchase_places',
            'stores',
            'ingredients_text',
            'traces',
            'serving_size',
            'serving_quantity',
            'nutriscore_score',
            'nutriscore_grade',
            'main_category',
            'image_url',
        ]
    ]);
//
//    expect($response['_id'])->toBe($product->getKey());

});

//it('behaves as expected when getting all products paginated', function () {});
//it('behaves as expected when updating product data', function () {});
//it('behaves as expected when deleting a product ', function () {});
