<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index (Request $request): JsonResponse
    {

        $request->validate([
            'perPage' => ['numeric'],
            'page' => ['numeric'],
            'search' => ['string'],
            'sortField' => ['string'],
            'sortDirection' => ['string', 'in:desc,asc'],
        ]);

        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);
        $search = $request->input('search', '');
        $sortDirection = $request->input('sortDirection', 'desc');
        $sortField = $request->input('sortField', 'updated_at');

        $query = Product::query();
        
        if ($search) {
            $query = $query->where('title', 'like', "%{$search}%");
        }

        $count = $query->count();
        
        $query = $query
                    ->orderBy($sortField, $sortDirection)
                    ->paginate(perPage: $perPage, page: $page);

        return new JsonResponse(["products" => ProductListResource::collection($query), "totalCount" => $count]);
    }

    public function store (ProductRequest $request, ProductService $productService): JsonResponse
    {
        $productData = $request->validated();
        $productData['created_by'] = $request->user()->id;
        $productData['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\File|\Illuminate\Http\UploadedFile $image */
        $image = $productData['image'] ?? null;

        if ($image) {
            $productData['image'] = $productService->saveImage($image);
            $productData['image_mime'] = $image->getClientMimeType();
            $productData['image_size'] = $image->getSize();
        }

        $product = Product::create($productData);
        return new JsonResponse(new ProductResource($product), Response::HTTP_CREATED);
    }

    public function show(Product $product): JsonResponse
    {
        return new JsonResponse(new ProductResource($product));
    }

    public function update(
        ProductRequest $request, 
        Product $product, 
        ProductService $productService
    ): JsonResponse
    {
        $productData = $request->validated();
        $productData['updated_by'] = $request->user()->id;

        $image = $productData['image'] ?? null;
        if ($image) {
            $productData['image'] = $productService->saveImage($image);
            $productData['image_mime'] = $image->getClientMimeType();
            $productData['image_size'] = $image->getSize();
        }

        if ($product->image) {
            $productService->removeImage($product->image);
        }

        $product->update($productData);

        return new JsonResponse(new ProductResource($product));
    }

    public function destroy(Product $product, ProductService $productService): JsonResponse
    {
        if ($product->image) {
            $productService->removeImage($product->image);
        }

        $product->delete();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
