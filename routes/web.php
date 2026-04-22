<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\PillarExcelController;

use App\Exports\PillarExport;
use Maatwebsite\Excel\Facades\Excel;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::get('/redirect', [HomeController::class, 'redirect']);

route::get('/', [HomeController::class, 'index']);

// Routes for Categories
Route::prefix('categories')->group(function () {
    Route::get('/', [AdminController::class, 'categories'])->name('categories');
    Route::post('/store', [AdminController::class, 'store_category'])->name('categories.store_category');
    Route::put('/update/{category}', [AdminController::class, 'update_category'])->name('categories.update_category');
    Route::delete('/delete/{category}', [AdminController::class, 'delete_category'])->name('categories.delete_category');
});

// Routes for Pillars
Route::prefix('pillars')->group(function () {
    Route::get('/', [AdminController::class, 'pillars'])->name('pillars');
    Route::post('/store', [AdminController::class, 'store_pillar'])->name('pillars.store_pillar');
    Route::put('/update/{pillar}', [AdminController::class, 'update_pillar'])->name('pillars.update_pillar');
    Route::delete('/delete/{pillar}', [AdminController::class, 'delete_pillar'])->name('pillars.delete_pillar');

    Route::get('/{category}', [AdminController::class, 'showCategoryPillars'])->name('pillars.show');
    Route::get('/pillars/category/{pillarId}', [AdminController::class, 'viewCategory'])->name('pillars.category');
   


});


// Excel Import
Route::post('/import-excel', [PillarExcelController::class, 'importExcel'])->name('import.excel');

// Excel Export
Route::get('/export-pillars', function () {
    return Excel::download(new PillarExport, 'pillars.xlsx');
})->name('export.pillars');