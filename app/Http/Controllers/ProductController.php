<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ShowProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request): AnonymousResourceCollection
    {
        return ShowProductResource::collection(
            $this->service->showAllProducts($request)
        );
    }


    public function show(int $productCode): ShowProductResource|JsonResponse
    {
        $product = $this->service->showProduct($productCode);

        if(!$product){
            return response()
                ->json(
                    [],
                    HttpResponse::HTTP_NOT_FOUND
                );
        }

        return new ShowProductResource($product);
    }

    public function update(UpdateProductRequest $request, int $productCode): ShowProductResource
    {
        return new ShowProductResource(
            $this->service->updateProduct(
                $request->validated(),
                $productCode
            )
        );
    }

    public function destroy(int $productCode): Response
    {
        $this->service->deleteProduct($productCode);

        return response([], HttpResponse::HTTP_NO_CONTENT);
    }
}
