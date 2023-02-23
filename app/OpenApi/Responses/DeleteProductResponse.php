<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class DeleteProductResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::create()
            ->description('Successful response')
            ->statusCode(HttpResponse::HTTP_NO_CONTENT);
    }
}
