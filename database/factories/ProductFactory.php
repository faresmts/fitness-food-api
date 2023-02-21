<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'code' => fake()->numberBetween(10000000, 99999999),
            'status' => 'published',
            'imported_t' => Carbon::now()->timestamp(),
            'url' => fake()->url,
            'creator' => fake()->name(),
            'created_t' => fake()->unixTime(),
            'last_modified_t' => fake()->unixTime(),
            'product_name' => fake()->word,
            'quantity' => '380 g (6 x 2 u.)',
            'brands' => fake()->name,
            'categories' => fake()->words(10),
            'labels' => fake()->words(10),
            'cities' => fake()->city,
            'purchase_places' => fake()->city,
            'stores' => fake()->name,
            'ingredients_text' => fake()->words(10),
            'traces' => fake()->words(10),
            'serving_size' => 'madalena 31.7 g',
            'serving_quantity' => fake()->randomFloat(1),
            'nutriscore_score' => fake()->numberBetween(-1,  100),
            'nutriscore_grade' => 'a',
            'main_category' => fake()->word,
            'image_url' => fake()->imageUrl,
        ];
    }
}
