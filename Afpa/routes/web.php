<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CtrlNDS;

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


//ADMIN 

Route::get('/admin/note_de_services', [CtrlNDS::class, 'indexAdminNDS'])->name('indexAdminNDS');
Route::get('/admin/note_de_services/nouveau', [CtrlNDS::class, 'afficherFormulaireNDS'])->name('createNDS');
Route::post('/admin/note_de_services/nouveau', [CtrlNDS::class, 'nouveauNDS'])->name('saveNDS');
Route::delete('/admin/note_de_services/{id}', [CtrlNDS::class, 'softDeleteNDS'])->name('softDeleteNDS');
Route::get('/admin/note_de_services/{id}/modifier', [CtrlNDS::class, 'selectNDS'])->name('upNDS');
Route::put('/admin/note_de_services/{id}', [CtrlNDS::class, 'editNDS'])->name('updateNDS');

//USER

Route::get('/note_de_services', [CtrlNDS::class, 'indexNDS'])->name('indexNDS');


//HORS SUJET

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
