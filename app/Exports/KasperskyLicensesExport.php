<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasperskyLicensesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Here, we are returning static data for now. You can replace it with your model data later.
        return collect([
            ['ABCD-1234-EFGH-5678', 'Kaspersky Total Security', '2025-12-31', 'Partner A'],
            ['EFGH-2345-IJKL-6789', 'Kaspersky Internet Security', '2024-11-30', 'Partner B'],
            ['IJKL-3456-MNOP-7890', 'Kaspersky Anti-Virus', '2024-10-15', 'Partner C'],
            ['MNOP-4567-QRST-8901', 'Kaspersky Endpoint Security', '2026-05-20', 'Partner A'],
        ]);
    }

    public function headings(): array
    {
        return ['License Key', 'Product', 'Expiry Date', 'Partner'];
    }
}
