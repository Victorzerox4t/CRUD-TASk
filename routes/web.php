<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\drinkController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DrinkController::class, 'index'])->name('drink.index');
    Route::get('/tambah', [DrinkController::class, 'tambah'])->name('drink.tambah');
    Route::post('/prosesTambah', [DrinkController::class, 'prosesTambah'])->name('drink.prosesTambah');
    Route::get('/edit/{id}', [DrinkController::class, 'edit'])->name('drink.edit');
    Route::put('/prosesEdit/{id}', [DrinkController::class, 'prosesEdit'])->name('drink.prosesEdit');
    Route::get('/hapus/{id}', [DrinkController::class, 'hapus'])->name('drink.hapus');
});
Route::get('file/{filename}', function ($filename) {
    $path = storage_path('app/public/images/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage');
