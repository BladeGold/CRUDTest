<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'referencia', 'descripcion', 'precio', 'tipo_producto'];

    public function variant(){
        return $this->hasMany(ProductVariant::class);
    }
}
