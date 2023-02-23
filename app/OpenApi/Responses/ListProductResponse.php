<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ListProductResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::object('data')->properties(
                Schema::integer('code')->example(13),
                Schema::string('status')->example('draft'),
                Schema::string('imported_t')->example('2023-02-22 22:48:33'),
                Schema::string('url')->example('http://world-en.openfoodfacts.org/product/0000000000017/vitoria-crackers'),
                Schema::string('creator')->example('fares THE DEV'),
                Schema::string('created_t')->example('1529059080'),
                Schema::string('last_modified_t')->example('1561463718'),
                Schema::string('product_name')->example('Vitória crackers'),
                Schema::string('quantity')->example('380 g (6 x 2 u.)'),
                Schema::string('brands')->example('La Cestera'),
                Schema::string('categories')->example('Lanches comida, Lanches doces, Biscoitos e Bolos, Bolos, Madalenas'),
                Schema::string('labels')->example('Contem gluten, Contém derivados de ovos, Contém ovos'),
                Schema::string('cities')->example('Braga,Portugal'),
                Schema::string('purchase_places')->example('Lidl'),
                Schema::string('stores')->example('Padaria Joaquim'),
                Schema::string('ingredients_text')->example('farinha de trigo, açúcar, óleo vegetal de girassol, clara de ovo, ovo, humidificante (sorbitol), levedantes químicos (difosfato dissódico, hidrogenocarbonato de sódio), xarope de glucose-frutose, sal, aroma'),
                Schema::string('traces')->example('Frutos de casca rija,Leite,Soja,Sementes de sésamo,Produtos à base de sementes de sésamo'),
                Schema::string('serving_size')->example('madalena 31.7 g'),
                Schema::number('serving_quantity')->example('31.7'),
                Schema::integer('nutriscore_score')->example('20'),
                Schema::string('nutriscore_grade')->example('d'),
                Schema::string('main_category')->example('en:madeleines'),
                Schema::string('image_url')->example('https://static.openfoodfacts.org/images/products/20221126/front_pt.5.400.jpg'),
            )
        );

        return Response::create('ListProduct')
            ->statusCode('200')
            ->content(
                MediaType::json()->schema($response)
            );

    }
}
