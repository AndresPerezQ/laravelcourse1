<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductRequest;

class ProductApiControllerV4 extends Controller
{
    public function index(): JsonResponse 
    { 
        $products = Product::all(); 
        return response()->json($products, 200); 
    } 
 
    public function show(string $id): JsonResponse 
    { 
        $product = Product::findOrFail($id); 
        return response()->json($product, 200); 
    } 

    public function store(StoreProductRequest $request): JsonResponse
    {
        $request->validated();

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->save();

        return response()->json([
            'message' => 'Producto creado satisfactoriamente',
            'data' => $product
        ], 201);
    }
}