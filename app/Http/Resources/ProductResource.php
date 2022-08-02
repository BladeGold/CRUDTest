<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'referencia' => $this->referencia,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'tipo_producto' => $this->tipo_producto,
            'variant' => $this->when($this->variant, $this->variant)
        ];
    }
}
