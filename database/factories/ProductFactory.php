<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use MongoDB\BSON\ObjectId;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            '_id' => new ObjectId(),
            'code' => fake()->numerify('########'),
            'status' => 'published',
            'imported_t' => Carbon::now(),
            'url' => fake()->url,
            'creator' => fake()->name(),
            'created_t' => fake()->unixTime(),
            'last_modified_t' => fake()->unixTime(),
            'product_name' => fake()->word,
            'quantity' => fake()->randomFloat(1, 1, 100) . ' g' . ' (' . fake()->numberBetween(1, 10) . ' x ' . fake()->numberBetween(1, 10) . ' u.)',
            'brands' => fake()->name,
            'categories' => fake()->word(),
            'labels' => fake()->word(),
            'cities' => fake()->city,
            'purchase_places' => fake()->city,
            'stores' => fake()->name,
            'ingredients_text' => fake()->word(),
            'traces' => fake()->word(),
            'serving_size' => fake()->word . ' ' . fake()->randomFloat(1, 1, 100) . ' g',
            'serving_quantity' => fake()->randomFloat(1),
            'nutriscore_score' => fake()->numberBetween(-1,  100),
            'nutriscore_grade' => 'a',
            'main_category' => fake()->word,
            'image_url' => fake()->imageUrl,
        ];
    }
}
