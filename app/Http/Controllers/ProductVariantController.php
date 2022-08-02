<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use App\Http\Services\ProductVariantService;

use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    
    protected $productVariantService;

    public function __construct(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {  
        $this->productVariantService->createVariant($product, $request->variant);
        return $this->findProduct($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductVariant $productVariant, Request $request)
    {
        return $this->productVariantService->updateVariant($productVariant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductVariant $productVariant)
    {
        return $this->productVariantService->deleteVariant($productVariant);
    }

    public function findProduct($product)
    {
        return ProductVariant::where('product_id', $product->id)->get();
    }
}
