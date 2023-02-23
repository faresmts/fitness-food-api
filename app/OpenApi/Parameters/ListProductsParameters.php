<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListProductsParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('per_page')
                ->description('number of products per page')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('page')
                ->description('product page number')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
