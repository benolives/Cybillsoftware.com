<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories only if they don't already exist
        Category::firstOrCreate([
            'name' => 'Kaspersky',
            'slug' => 'kaspersky',
        ]);
        
        Category::firstOrCreate([
            'name' => 'Bitdefender',
            'slug' => 'bitdefender',
        ]);
    }
}
