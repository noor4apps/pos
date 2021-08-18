<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product1['name'] = [
            'ar' => 'product1 ar',
            'en' => 'product1 en'
        ];
        $product1['description'] = [
            'ar' => 'desc product1 ar',
            'en' => 'desc product1 en'
        ];
        $product1['purchase_price'] = 100.89;
        $product1['sale_price'] = 150.58;
        $product1['stock'] = 10;
        $product1['category_id'] = 1;

        $product2['name'] = [
            'ar' => 'product2 ar',
            'en' => 'product2 en'
        ];
        $product2['description'] = [
            'ar' => 'desc product2 ar',
            'en' => 'desc product2 en'
        ];
        $product2['purchase_price'] = 50.57;
        $product2['sale_price'] = 60.78;
        $product2['stock'] = 2;
        $product2['category_id'] = 1;

        $product3['name'] = [
            'ar' => 'product3 ar',
            'en' => 'product3 en'
        ];
        $product3['description'] = [
            'ar' => 'desc product3 ar',
            'en' => 'desc product3 en'
        ];
        $product3['purchase_price'] = 80.95;
        $product3['sale_price'] = 90.78;
        $product3['stock'] = 100;
        $product3['category_id'] = 2;

        Product::create($product1);
        Product::create($product2);
        Product::create($product3);
    }
}
