<?php

namespace App\Http\Services;

use App\Http\Resources\ProductVariantResource;
use App\Models\ProductVariant;

class ProductVariantService {

    public function getAllVariant($product)
    {
        return $product->variant;
    }

    public function createVariant($product, $variants)
    {   
        $counter = $this->getCounterVariant($product);
        $referencia = $this->getReferencia($product);
        foreach ($variants as $variant) {
            
            $number = $referencia['number']+$counter;
            
            ProductVariant::create([
                'referencia' => $referencia['string'].$number,
                'descripcion' => $variant['descripcion'],
                'product_id' => $product->id,
                'precio' => $variant['precio']
            ]);
            
            $counter++;
        }
    }

    public function getVariant($variant)
    {
        return ProductVariantResource::make($variant);
    }

    public function updateVariants($variants)
    {
        foreach ($variants as $variant ) {
            ProductVariant::where('id', $variant['id'])->update([
                'precio' => $variant['precio'],
                'descripcion' => $variant['descripcion']
            ]);
        }
    }

    public function updateVariant($variant, $request)
    {
        $variant->descripcion = $request->descripcion;
        $variant->precio = $request->precio;

        if($variant->save()){
            return ProductVariantResource::make($variant);
        }

        return response()->json(['error' => 'Algo salió mal'], 400);
    }

    public function deleteVariant($variant)
    {
        if($variant->delete()){
            return response()->json('Succes',204);
        }
        return response()->json(['error' => 'Algo salió mal'], 400);
    }

    private function getCounterVariant($product)
    {
        $count =  ProductVariant::where('product_id',$product->id)->count();
        if($count == 0){
            return $count+1;
        }
        return $count+1;

    }

    private function getReferencia($product)
    {
        $number =  (int) substr($product->referencia, 3, 5);
        if($number < 1000) {
            $string =  substr($product->referencia, 0, -5).'00';
        }
        if($number  >= 1000 && $number < 10000 ) {
            $string =  substr($product->referencia, 0, -5).'0';
        }
        if($number  >= 10000 ) {
            $string =  substr($product->referencia, 0, -5);
        }
        return $referencia = ['number' => $number, 'string' => $string];
    }

}