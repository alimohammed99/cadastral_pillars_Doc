<?php

namespace App\Http\Controllers;

use App\Imports\PillarImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class PillarExcelController extends Controller
{
    public function importExcel(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $categoryId = $request->input('category_id'); // Get category ID from form

        Excel::import(new PillarImport($categoryId), $request->file('file'));

        return redirect()->back()->with('success', 'File imported successfully.');
    }
}