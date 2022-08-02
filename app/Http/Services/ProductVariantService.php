<?php

namespace App\Http\Services;


use App\Models\ProductVariant;

class ProductVariantService {

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

    public function updateVariant($variants)
    {
        foreach ($variants as $variant ) {
            ProductVariant::where('id', $variant['id'])->update([
                'precio' => $variant['precio'],
                'descripcion' => $variant['descripcion']
            ]);
        }
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