<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KasperskyKeysImport;
use App\Models\KasperskyKey;

class ImportController extends Controller
{
    /**
     * Handle the import of Kaspersky keys.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function importKasperskyKeys(Request $request)
    {
        // Validate the incoming file
        // Maximum file size 2MB
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);

        try {
            // Import the file
            Excel::import(new KasperskyKeysImport, $request->file('file'));

            // Success message
            return redirect()->back()->with('success', 'Kaspersky keys imported successfully!');
        } catch (\Exception $e) {
            // Error handling
            return redirect()->back()->with('error', 'There was an issue with the import. Please check the file format and try again.');
        }
    }
}