<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\ProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class ProductUpdateRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('ProductUpdate')
            ->description('Product data')
            ->content(
                MediaType::json()->schema(ProductSchema::ref())
            );
    }
}
