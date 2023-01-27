<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    public function index (Request $request): JsonResponse
    {

        $request->validate([
            'perPage' => ['numeric'],
            'search' => ['string'],
            'sortField' => ['string'],
            'sortDirection' => ['string', 'in:desc,asc', 'nullable']
        ]);

        $perPage = $request->input('perPage', 10);
        $search = $request->input('search', '');
        $sortField = $request->input('sortField', 'updated_at');
        $sortField = $request->input('sortDirection');

        $query = Product::query()
            ->where('title', 'like', "%{$search}%")
            ->orderBy($sortField, $sortField)
            ->paginate($perPage);

        return new JsonResponse(ProductListResource::collection($query));
    }

    public function create (ProductRequest $request): JsonResponse
    {
        $productData = $request->validated();
        $productData['created_by'] = $request->user()->id;
        $productData['updated_by'] = $request->user()->id;

        $image = $data['image'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $productData['image'] = URL::to(Storage::url($relativePath));
            $productData['image_mime'] = $image->getClientMimeType();
            $productData['image_size'] = $image->getSize();
        }

        $product = Product::create($productData);

        return new JsonResponse(new ProductResource($product), Response::HTTP_CREATED);
    }

    public function get(Product $product): JsonResponse
    {
        return new JsonResponse(new ProductResource($product));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $productData = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $image = $data['image'] ?? null;
        if ($image) {
            $relativePath = $this->saveImage($image);
            $productData['image'] = URL::to(Storage::url($relativePath));
            $productData['image_mime'] = $image->getClientMimeType();
            $productData['image_size'] = $image->getSize();
        }

        if ($product->image) {
            Storage::deleteDirectory('/public/' . dirname($product->image));
        }

        $product->update($productData);

        return new JsonResponse(new ProductResource($product);
    }
}
