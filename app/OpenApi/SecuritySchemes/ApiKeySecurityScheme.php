<?php

namespace App\OpenApi\SecuritySchemes;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;
use Vyuldashev\LaravelOpenApi\Factories\SecuritySchemeFactory;

class ApiKeySecurityScheme extends SecuritySchemeFactory
{
    public function build(): SecurityScheme
    {
        return SecurityScheme::create('FitnessFoodApiKey')
            ->type(SecurityScheme::TYPE_API_KEY)
            ->scheme('apiKey');
    }
}
