<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this to use DB facade
use App\Models\ProductKey;

class ProductKeysTableSeeder extends Seeder
{
    /**
     * Seed the product_keys table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_keys')->insert([
            ['id' => 1, 'product_id' => 11, 'key_code' => 'key_code_1', 'sold_status' => 'available', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'product_id' => 12, 'key_code' => 'key_code_2', 'sold_status' => 'available', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'product_id' => 13, 'key_code' => 'key_code_3', 'sold_status' => 'available', 'created_at' => now(), 'updated_at' => now()],
        ]);
       foreach ($data as $item) {
            ProductKey::updateOrCreate(
                ['product_id' => $item['product_id']],
                $item
            );
        } 
    }
}