<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class SystemInfoResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::object('data')->properties(
                Schema::string('db_connection')->example('🟢 ON'),
                Schema::string('db_writing')->example('🟢 ON'),
                Schema::string('last_cron_time')->example('2023-02-22 19:45:27'),
                Schema::string('online_since')->example('up 3 hours, 12 minutes'),
                Schema::string('memory_use')->example('8.1Gi'),
            ));

        return Response::create('SystemInfo')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}

