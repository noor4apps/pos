<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1['name'] = [
            'ar' => 'القسم الاول',
            'en' => 'category 1',
        ];
        $cat2['name'] = [
            'ar' => 'القسم الثاني',
            'en' => 'category 2',
        ];
        $cat3['name'] = [
            'ar' => 'القسم الثالث',
            'en' => 'category 3',
        ];
        $cat4['name'] = [
            'ar' => 'القسم الرابع',
            'en' => 'category 4',
        ];

        Category::create($cat1);
        Category::create($cat2);
        Category::create($cat3);
        Category::create($cat4);
    }
}
