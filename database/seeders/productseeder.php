<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name_ar' => 'فحص عام',
            'name_en' => 'diagnoses',
            // Add more rows as needed
        ]);
        DB::table('products')->insert([
            'id' => '1',
            'category_id' => '1',
            'code' => '#1-1',
            'name_ar' => 'فحص عام',
            'name_en' => 'diagnoses',
            'description_ar' => 'فحص السيارات عند الدخول وتحديد ما يجب القيام به',
            'description_en' => 'diagnose the car at the entry ',
            'image' => '',
            'type ' => 'service',

        ]);
        DB::table('products')->insert([
            'id' => '1',
            'product_id' => '1',
            'unit' => 'piece',
            'price' => '10',
        ]);
    }
}
