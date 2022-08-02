<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cocacola = Product::create([
            'nombre' => 'Coca-Cola',
            'referencia' => 'COC00100',
            'descripcion' => 'Gaseosa sabor a cola 2 Lts',
            'precio' => 2500,
            'tipo_producto' => 'variable'
        ]);

        $cocacola->variant()->create([
            'referencia' => 'COC00101',
            'descripcion' => 'Gaseasa sabor a Cola 3 Lts',
            'precio' => 3500
        ]);
        
        $cocacola->variant()->create([
            'referencia' => 'COC00102',
            'descripcion' => 'Gaseasa sabor a Cola 1.5 Lts',
            'precio' => 2000
        ]);

        $cocacola->variant()->create([
            'referencia' => 'COC00103',
            'descripcion' => 'Gaseasa sabor a Cola 1.25 Lts',
            'precio' => 1800
        ]);

        $margarina = Product::create([
            'nombre' => 'Margarina',
            'referencia' => 'MAR00200',
            'descripcion' => 'Margarina 1 Kg',
            'precio' => 2500,
            'tipo_producto' => 'variable'
        ]);

        $margarina->variant()->create([
            'referencia' => 'MAR00201',
            'descripcion' => 'Margarina 500 grs',
            'precio' => 1800
        ]);

        $margarina->variant()->create([
            'referencia' => 'MAR00202',
            'descripcion' => 'Margarina 250 grs',
            'precio' => 1200
        ]);
    }
}
