<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ListAllProductsResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::object('data')->properties(
                Schema::object()->properties(
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
                ),
                Schema::object()->properties(
                    Schema::integer('code')->example(17),
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
                ),
                Schema::object('links')->properties(
                    Schema::string('first')->example('http://localhost:8080/api/products?page=1'),
                    Schema::string('last')->example('http://localhost:8080/api/products?page=450'),
                    Schema::string('prev')->example(null),
                    Schema::string('next')->example('http://localhost:8080/api/products?page=2'),
                ),
                Schema::object('meta')->properties(
                    Schema::string('current_page')->example(1),
                    Schema::string('from')->example(1),
                    Schema::string('last_page')->example(450),
                    Schema::object('links')->properties(
                        Schema::object()->properties(
                            Schema::string('url')->example(null),
                            Schema::string('label')->example('pagination.previous'),
                            Schema::string('active')->example(false),
                        ),
                        Schema::object()->properties(
                            Schema::string('url')->example('http://localhost:8080/api/products?page=1'),
                            Schema::string('label')->example(1),
                            Schema::string('active')->example(true),
                        ),
                    ),
                    Schema::string('path')->example('http://localhost:8080/api/products'),
                    Schema::string('per_page')->example(2),
                    Schema::string('to_page')->example(2),
                    Schema::string('total')->example(900),
                ),
               )
        );

        return Response::create('ListAllProducts')
            ->statusCode('200')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
