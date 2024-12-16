<?php

namespace App\Imports;

use App\Models\KasperskyKey;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class KasperskyKeysImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {
        // Log each row import attempt
        Log::info('Processing row for import', ['row' => $row]);

        // Check if product_id and key_code are present before importing
        if (empty($row['product_id']) || empty($row['key_code'])) {
            Log::warning('Skipping row due to missing product_id or key_code', ['row' => $row]);
            return null; // Skip rows that don't have the necessary data
        }

        // Log when a valid row is being processed
        Log::info('Importing valid row', ['product_id' => $row['product_id'], 'key_code' => $row['key_code']]);

        return new KasperskyKey([
            'product_id' => $row['product_id'], // Product ID from the Excel file
            'key_code'   => $row['key_code'],   // Key code from the Excel file
            'sold_status' => 0, // Default to not sold
        ]);
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',  // Ensure product_id exists in the products table
            'key_code'   => 'required|string|unique:kaspersky_keys,key_code', // Ensure the key_code is unique
        ];
    }

    public function customValidationMessages()
    {
        return [
            'product_id.required' => 'The product ID is required.',
            'product_id.exists' => 'The product ID does not exist in the products table.',
            'key_code.required' => 'The key code is required.',
            'key_code.unique' => 'The key code must be unique.',
        ];
    }

    public function onFailure(array $failures)
    {
        // Log validation failures
        foreach ($failures as $failure) {
            Log::error('Validation error', [
                'row' => $failure->values(),
                'error' => $failure->errors()
            ]);
        }
    }

    /**
     * Log import start.
     *
     * @return void
     */
    public function onStart()
    {
        Log::info('Starting Kaspersky keys import...');
    }

    /**
     * Log import completion.
     *
     * @return void
     */
    public function onComplete()
    {
        Log::info('Kaspersky keys import completed successfully!');
    }
}