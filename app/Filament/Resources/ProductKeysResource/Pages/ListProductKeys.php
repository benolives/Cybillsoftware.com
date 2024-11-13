<?php

namespace App\Filament\Resources\ProductKeysResource\Pages;

use Filament\Actions;
// use Filament\Resources\ProductKeys;
use App\Models\Product;
use App\Models\ProductKeys;
use Illuminate\Contracts\View\View;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProductKeysResource;
use App\Imports\ImportProductKeys;
use Filament\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class ListProductKeys extends ListRecords
{
    protected static string $resource = ProductKeysResource::class;

    public $selectedProductId;

    public $file = '';

    public $products;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make();
        $products = Product::all();
        
        // return view('filament.custom.upload-file', compact('data', 'products'));
        return view('filament.custom.upload-file', [
            'data' => $data,
            'products' => $products,
        ]);
    }


    public function save()
    {
        if($this->file != '') {
            Excel::import(new ImportProductKeys($this->selectedProductId), $this->file);
        }
    }       

   
    // public function save()
    // {
    //     ProductKeys::create([
    //         'product_id' => $this->selectedProductId,
    //         'key_code' => 'ASWD9AWDO83OQE832',
    //     ]);
    // }

}
