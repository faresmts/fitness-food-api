<?php

namespace App\Http\Controllers;

use App\Http\Resources\SystemInfoResource;
use App\Services\SystemService;

class SystemController extends Controller
{
    private SystemService $service;

    public function __construct(SystemService $service)
    {
        $this->service = $service;
    }
    public function info(): SystemInfoResource
    {
        return new SystemInfoResource($this->service->getSystemData());
    }
}
