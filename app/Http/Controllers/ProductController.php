<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        return new ProductCollection(Product::orderBy('name')->paginate(25));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'price' => 'required|numeric'
        ]);

        $product->update($attributes);

        return response()->json(['message' => $product->name . ' успешно обновлен']);
    }
}
