<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\KasperskyKeysExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
     /**
     * Export Kaspersky keys to Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportKasperskyKeys()
    {
        return Excel::download(new KasperskyKeysExport, 'kaspersky_keys.xlsx');
    }
}
