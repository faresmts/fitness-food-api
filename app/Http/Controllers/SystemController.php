<?php

namespace App\Http\Controllers;

use App\Http\Resources\SystemInfoResource;
use App\OpenApi\Responses\SystemInfoResponse;
use App\Services\SystemService;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class SystemController extends Controller
{
    private SystemService $service;

    public function __construct(SystemService $service)
    {
        $this->service = $service;
    }

    /**
     * Show system info
     *
     */

    #[OpenApi\Operation(tags: ['System'], method: 'GET')]
    #[OpenApi\Response(factory: SystemInfoResponse::class, statusCode: 200)]
    public function info(): SystemInfoResource
    {
        return new SystemInfoResource($this->service->getSystemData());
    }
}
