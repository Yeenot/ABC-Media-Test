<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Products\GetProducts;
use App\Services\Products\CreateProduct;
use App\Services\Products\GetProduct;
use App\Services\Products\UpdateProduct;
use App\Services\Products\DeleteProduct;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\BaseResource;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\Products\GetProducts  $getProducts
     * @return \Illuminate\Http\Response
     */
    public function index(GetProducts $getProducts)
    {
        return (new BaseCollection(
            ProductCollection::class,
            $getProducts->execute()
        ))->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Products\CreateProduct  $createProduct
     * @param  \App\Services\Products\DeleteProduct  $deleteProduct
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $createProduct, ProductStoreRequest $request)
    {
        $createProduct->execute($request->validated());
        return response()->json(['message' => 'Product added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Products\GetProduct  $getProduct
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GetProduct $getProduct, $id)
    {
        return (new BaseResource(
            ProductResource::class,
            $getProduct->execute($id)
        ))->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Products\UpdateProduct  $updateProduct
     * @param  \App\Http\Requests\Products\ProductUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $updateProduct, ProductUpdateRequest $request, $id)
    {
        $updateProduct->execute($id, $request->validated());
        return response()->json(['message' => 'Product updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services\Products\DeleteProduct  $deleteProduct
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteProduct $deleteProduct, $id)
    {
        $deleteProduct->execute($id);
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
