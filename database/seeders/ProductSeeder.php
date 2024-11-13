<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Kaspersky and Bitdefender categories
        $kaspersky = Category::where('name', 'Kaspersky')->first();
        $bitdefender = Category::where('name', 'Bitdefender')->first();

        // Kaspersky standard plan 
        Product::firstOrCreate([
            'product_name' => 'Kaspersky Standard',
            'product_plan_name' => 'Standard Plan',
            'description' => 'Internet Security',
            'reviews' => 207,
            'discount_percentage' => 20,
            'compatibility' => json_encode(['macOS', 'Windows', 'Android', 'iOS']),
            'benefits' => json_encode([
                'Real-time Antivirus', 
                'Online Payment Protection', 
                'Performance Optimization',
            ]),
            'learn_more_link' => 'https://www.kaspersky.co.za/standard',
            'price' => 3740,
            'price_offer' => 3029,
            'price_partner' => 2900,
            'product_link' => 'https://www.kaspersky.co.za/standard',
            'image_url' => env('APP_URL') . '/assets/img/kaspersky_standard.svg',
            'category_id' => $kaspersky->id,
        ]);
        //kaspersky plus plan
        Product::firstOrCreate([
            'product_name' => 'Kaspersky Plus',
            'product_plan_name' => 'Plus Plan',
            'description' => 'Antivirus, Internet Security',
            'reviews' => 316,
            'discount_percentage' => 19,
            'compatibility' => json_encode(['macOS', 'Windows', 'Android']),
            'benefits' => json_encode([
                'Real-time Antivirus', 
                'Online Payment Protection', 
                'Performance Optimization',
                'Unlimited Superfast VPN',
                'Data Leak Checker',
            ]),
            'learn_more_link' => 'https://www.kaspersky.com/plus',
            'price' => 3740,
            'price_offer' => 3029,
            'price_partner' => 2900,
            'product_link' => 'https://www.kaspersky.com/product/kaspersky-plus',
            'image_url' => env('APP_URL') . '/assets/img/kaspersky_plus.svg',
            'category_id' => $kaspersky->id,
        ]);
        //kaspersky premium plan
        Product::firstOrCreate([
            'product_name' => 'Kaspersky Premium',
            'product_plan_name' => 'Premium Plan',
            'description' => 'Total Security',
            'reviews' => 207,
            'discount_percentage' => 20,
            'compatibility' => json_encode(['macOS', 'Windows', 'Android', 'iOS']),
            'benefits' => json_encode([
                'Real-time Antivirus', 
                'Online Payment Protection', 
                'Performance Optimization',
                'Unlimited Superfast VPN',
                'Data Leak Checker',
                'Identity Protection',
                'Expert Virus Check & Removal',
                'Kaspersky Safe Kids 1 YEAR FREE',
            ]),
            'learn_more_link' => 'https://www.kaspersky.co.za/premium',
            'price' => 4808,
            'price_offer' => 3750,
            'price_partner' => 3500,
            'product_link' => 'https://www.kaspersky.co.za/premium',
            'image_url' => env('APP_URL') . '/assets/img/kapsersky_premium.svg',
            'category_id' => $kaspersky->id,
        ]);


        // Bitdefender Products
        Product::firstOrCreate([
            'product_name' => 'Bitdefender Total Security',
            'product_plan_name' => 'Total security',
            'description' => '1 account & 5 devices',
            'reviews' => 207,
            'discount_percentage' => 45,
            'compatibility' => json_encode(['macOS', 'Windows', 'Android', 'iOS']),
            'benefits' => json_encode([
                'Multiplatform Windows®, macOS®, Android™, iOS®', 
                'Cryptomining Protection', 
                'Scam Prevention & Detection',
                'Standard VPN',
                'Bitdefenders standard protection suite, against adware, malware, web attacks & ransomware',
            ]),
            'learn_more_link' => 'https://www.bitdefender.com/en-us/consumer/total-security',
            'price' => 14170,
            'price_offer' => 7670,
            'price_partner' => 7000,
            'product_link' => 'https://www.bitdefender.com/en-us/consumer/total-security',
            'image_url' => env('APP_URL') . '/assets/img/bitdefender.png',
            'category_id' => $bitdefender->id,
        ]);

        Product::firstOrCreate([
            'product_name' => 'Bitdefender Total Security',
            'product_plan_name' => 'Total security',
            'description' => '1 account & 5 devices',
            'reviews' => 207,
            'discount_percentage' => 45,
            'compatibility' => json_encode(['macOS', 'Windows', 'Android', 'iOS']),
            'benefits' => json_encode([
                'Multiplatform Windows®, macOS®, Android™, iOS®', 
                'Cryptomining Protection', 
                'Scam Prevention & Detection',
                'Standard VPN',
                'Bitdefenders standard protection suite, against adware, malware, web attacks & ransomware',
            ]),
            'learn_more_link' => 'https://www.bitdefender.com/en-us/consumer/total-security',
            'price' => 14170,
            'price_offer' => 7670,
            'price_partner' => 7000,
            'product_link' => 'https://www.bitdefender.com/en-us/consumer/total-security',
            'image_url' => env('APP_URL') . '/assets/img/bitdefender.png',
            'category_id' => $bitdefender->id,
        ]);

        Product::firstOrCreate([
            'product_name' => 'Bitdefender Total Security',
            'product_plan_name' => 'Total security',
            'description' => '1 account & 5 devices',
            'reviews' => 207,
            'discount_percentage' => 45,
            'compatibility' => json_encode(['macOS', 'Windows', 'Android', 'iOS']),
            'benefits' => json_encode([
                'Multiplatform Windows®, macOS®, Android™, iOS®', 
                'Cryptomining Protection', 
                'Scam Prevention & Detection',
                'Standard VPN',
                'Bitdefenders standard protection suite, against adware, malware, web attacks & ransomware',
            ]),
            'learn_more_link' => 'https://www.bitdefender.com/en-us/consumer/total-security',
            'price' => 14170,
            'price_offer' => 7670,
            'price_partner' => 7000,
            'product_link' => 'https://www.bitdefender.com/en-us/consumer/total-security',
            'image_url' => env('APP_URL') . '/assets/img/bitdefender.png',
            'category_id' => $bitdefender->id,
        ]);
    }
}
