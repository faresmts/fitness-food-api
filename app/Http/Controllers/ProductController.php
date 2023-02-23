<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ShowProductResource;
use App\Models\Product;
use App\OpenApi\Parameters\ListProductsParameters;
use App\OpenApi\RequestBodies\ProductUpdateRequestBody;
use App\OpenApi\Responses\DeleteProductResponse;
use App\OpenApi\Responses\ListAllProductsResponse;
use App\OpenApi\Responses\ListProductResponse;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Show all products paginated
     */
    #[OpenApi\Operation(tags: ['Products'])]
    #[OpenApi\Parameters(factory: ListProductsParameters::class)]
    #[OpenApi\Response(factory: ListAllProductsResponse::class, statusCode: 200)]
    public function index(Request $request): AnonymousResourceCollection
    {
        return ShowProductResource::collection(
            $this->service->showAllProducts($request)
        );
    }

    /**
     * Show a specific product
     *
     * @param int $productCode Product Code
     */
    #[OpenApi\Operation(tags: ['Products'])]
    #[OpenApi\Response(factory: ListProductResponse::class, statusCode: 200)]
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

    /**
     * Update a specific product
     *
     * @param int $productCode Product Code
     */
    #[OpenApi\Operation(tags: ['Products'])]
    #[OpenApi\RequestBody(factory: ProductUpdateRequestBody::class)]
    #[OpenApi\Response(factory: ListProductResponse::class, statusCode: HttpResponse::HTTP_OK)]
    public function update(UpdateProductRequest $request, int $productCode): ShowProductResource
    {
        return new ShowProductResource(
            $this->service->updateProduct(
                $request->validated(),
                $productCode
            )
        );
    }

    /**
     * Delete a specific product
     *
     * @param int $productCode Product Code
     */
    #[OpenApi\Operation(tags: ['Products'])]
    #[OpenApi\Response(factory: DeleteProductResponse::class, statusCode: HttpResponse::HTTP_NO_CONTENT)]
    public function destroy(int $productCode): Response
    {
        $this->service->deleteProduct($productCode);

        return response([], HttpResponse::HTTP_NO_CONTENT);
    }
}
