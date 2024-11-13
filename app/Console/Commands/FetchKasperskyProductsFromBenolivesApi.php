<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ProductsController;
use App\Services\KasperskyBenOlivesApiService;

// This command fetches the products from BenOlives Api on A daily basis
// throught the controller in the productsController

class FetchKasperskyProductsFromBenolivesApi extends Command
{
    protected $signature = 'app:fetch-kaspersky-products-from-benolives-api';
    protected $description = 'Fetch Kaspersky products from the BenOlives API and store/update in the database';
    
    protected $kasperskyService;

    public function __construct(KasperskyBenOlivesApiService $kasperskyService)
    {
        parent::__construct();
        $this->kasperskyService = $kasperskyService;
    }

    public function handle()
    {
        try {
            $this->info('Fetching Kaspersky products...');
            
            // Call the service method to fetch and store products in DB
            $this->kasperskyService->fetchKasperskyProductsAndStoreInDB();

            $this->info('Kaspersky products fetched and stored successfully.');
        } catch (\Exception $e) {
            $this->error('Error fetching Kaspersky products: ' . $e->getMessage());
        }
    }
}
