<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [   
                'name'=>'Mi TV 55inch 4K',
                'categoryId'=>'1',
                'description'=>'Ready kirim hari ini, FREE ONGKIR!',
                'price'=>'5699000',
                'image'=>'xiaomitv.jpg'
            ],
            [
                'name'=>'Samsung S20 Ultra(12/128)',
                'categoryId'=>'2',
                'description'=>'Warna ready Black dan Gray',
                'price'=>'16145000',
                'image'=>'s20.jpg'
            ],
            [
                'name'=>'Macbook 16" inch 2020 512GB',
                'categoryId'=>'3',
                'description'=>'Barang Ready Stock, Original Apple 100%',
                'price'=>'42500000',
                'image'=>'macbook.jpg'
            ],
            [
                'name'=>'Iphone 11 Pro Max 256GB',
                'categoryId'=>'2',
                'description'=>'Garansi 1 tahun resmi IBOX',
                'price'=>'24200000',
                'image'=>'iphone.jpg'
            ]
        ]);
    }
}
