<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class ProductSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Product')
            ->properties(
                Schema::integer('code'),
                Schema::string('status'),
                Schema::string('imported_t'),
                Schema::string('url'),
                Schema::string('creator'),
                Schema::string('created_t'),
                Schema::string('last_modified_t'),
                Schema::string('product_name'),
                Schema::string('quantity'),
                Schema::string('brands'),
                Schema::string('categories'),
                Schema::string('labels'),
                Schema::string('cities'),
                Schema::string('purchase_places'),
                Schema::string('stores'),
                Schema::string('ingredients_text'),
                Schema::string('traces'),
                Schema::string('serving_size'),
                Schema::number('serving_quantity'),
                Schema::integer('nutriscore_score'),
                Schema::string('nutriscore_grade'),
                Schema::string('main_category'),
                Schema::string('image_url'),
            );
    }
}


