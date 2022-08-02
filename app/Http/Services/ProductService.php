<?php 

namespace  App\Http\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Resources\ProductsCollection;
use App\Http\Services\ProductVariantService;

class ProductService {

    protected $productVariantService;

    public function __construct(ProductVariantService $productService)
    {
        $this->productVariantService = $productService;
    }

    public function getAll()
    {
        return ProductsCollection::collection(Product::paginate(8));
    }
    
        public function get($id)
        {
            $product = Product::where('id', $id)->with('variant')->select('*')->get();
            return ProductResource::collection($product);
        }

    public function create($request)
    {   
       $product = Product::create([
            'nombre' => $request->nombre,
            'referencia' => $request->referencia,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'tipo_producto' => $request->tipo_producto
       ]);
        
        
        if(!empty($request->variant)){
            $this->productVariantService->createVariant($product, $request->variant);
        }

       return $this->get($product->id);
    }

    public function update($product, $request)
    {
        $product->nombre = $request->nombre;
        $product->referencia = $request->referencia;
        $product->descripcion = $request->descripcion;
        $product->precio = $request->precio;
        $product->tipo_producto = $request->tipo_producto;

        if(!empty($request->variant)){
            $this->productVariantService->updateVariant($request->variant);
        }

        if($product->save()){
            return $this->get($product->id);            
        }

        return response()->json(['error' => 'Algo salió mal'], 400);
    }

    public function destroy($product)
    {
        if(Product::where('id', $product->id)->delete()){
            return response()->json('Succes',204);
        }      
    }

}