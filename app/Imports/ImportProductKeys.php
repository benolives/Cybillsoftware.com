<?php

namespace App\Imports;

use App\Models\ProductKeys;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProductKeys implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $selectedProductId;

    public function __construct($selectedProductId)
    {
        $this->selectedProductId = $selectedProductId;
    }

    public function model(array $row)
    {
        return new ProductKeys([
            //
            'product_id' => $this->selectedProductId,
            'key_code'  => $row[1],
        ]);
    }
}
