<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class ClientsSeeder extends Seeder
{
    public function run()
    {
        $partners = User::whereIn('id', [7244, 7383, 7819])->get(); // Adjust based on your partner IDs

        foreach ($partners as $partner) {
            for ($i = 1; $i <= 5; $i++) {
                Client::create([
                    'partner_id' => $partner->id,
                    'partner_name' => $partner->name,
                    'name' => "Client {$i} for {$partner->name}",
                    'email' => "client{$i}@example.com", // Generate unique emails
                    'phone' => '070' . rand(1000000, 9999999), // Generate random phone numbers
                    'product_name' => 'Product ' . $i,
                    'product_price' => rand(100, 500), // Random price between 100 and 500
                    'commission_received' => 0, // Initialize as 0
                    'subscription_type' => 'Basic', // Example subscription type
                ]);
            }
        }
    }
}

