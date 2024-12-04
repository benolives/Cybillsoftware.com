<?php

namespace App\Exports;

use App\Models\KasperskyKey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KasperskyKeysExport implements FromCollection, WithHeadings, WithColumnFormatting, WithStyles
{
    /**
     * Return a collection of Kaspersky keys with the associated product name.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch Kaspersky keys with their associated product
        return KasperskyKey::with('product')->get()->map(function ($key) {
            return [
                'id' => $key->id,
                'product_name' => $key->product ? $key->product->product_name : 'N/A', // Fetch product name
                'key_code' => $key->key_code,
                'sold_status' => $key->sold_status == 0 ? 'Not Sold' : 'Sold',
                'created_at' => $key->created_at,
            ];
        });
    }

    /**
     * Define the headings for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'License Key',
            'Sold Status',
            'Time Acquired',
        ];
    }

    /**
     * Define column formatting (e.g., for the 'Time Acquired' column).
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    /**
     * Apply styles to the table in the export.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     * @return void
     */
    public function styles($sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // Bold headings
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center'); // Center align headings
    }
}