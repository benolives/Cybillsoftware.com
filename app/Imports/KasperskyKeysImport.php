<?php

namespace App\Imports;

use App\Models\KasperskyKey;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KasperskyKeysImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KasperskyKey([
            'product_id' => $row['product_id'], // Assumes the product_id is present in the Excel file
            'key_code'   => $row['key_code'],   // Assumes the key_code is present in the Excel file
            'sold_status' => 0, // Default to not sold
        ]);
    }

    /**
     * Define validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',  // Ensures product_id exists in the products table
            'key_code' => 'required|string|unique:kaspersky_keys,key_code', // Ensures the key_code is unique
        ];
    }
}