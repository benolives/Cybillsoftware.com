<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KasperskyKeysImport;
use App\Models\KasperskyKey;
use Illuminate\Support\Facades\Log;

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

        // Log the request for debugging
        Log::info('Received an import request', [
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_size' => $request->file('file')->getSize(),
        ]);

        try {
            // Log the start of the import process
            Log::info('Starting the import process');

            // Import the file
            Excel::import(new KasperskyKeysImport, $request->file('file'));

            // Log successful import
            Log::info('Import process completed successfully');

            // Success message
            return redirect()->back()->with('success', 'Kaspersky keys imported successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error during import: ' . $e->getMessage(), [
                'exception' => $e,
                'file_name' => $request->file('file')->getClientOriginalName(),
            ]);

            // Error handling
            return redirect()->back()->with('error', 'There was an issue with the import. Please check the file format and try again.');
        }
    }
}