<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class FitnessFoodsAuth
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('FitnessFoodApiKey', '');

        if(empty($apiKey)) {
            return response()->json([
                'Unauthorized' => 'Missing API key authorization',
            ], HttpResponse::HTTP_UNAUTHORIZED);
        }

        /**
         * @var ApiKey
         */
        $apiKeyExists = ApiKey::where('key', $apiKey)->exists();

        if(! $apiKeyExists){
            return response()->json([
                'Unauthorized' => 'User does not exists'
            ], HttpResponse::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
