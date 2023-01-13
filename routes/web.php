<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DetailTugasController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', [TugasController::class, 'data'])->name('tugas.data');
Route::get('/todolist/{id_tugas}', [TugasController::class, 'show'])->name('tugas.show');
Route::get('/todolist', [TugasController::class, 'index'])->name('tugas.index');
Route::post('/todolist', [TugasController::class, 'store'])->name('tugas.store');
Route::delete('/todolist/{id_tugas}', [TugasController::class, 'destroy'])->name('tugas.delete');
Route::put('/todolistStatus/{id_tugas}', [TugasController::class, 'updateStatus']);
Route::put('/todolist/{id_tugas}', [TugasController::class, 'update']);

Route::put('/detail-tugas/{id_detail_tugas}', [DetailTugasController::class, 'update'])->name('detail.update');
Route::post('/detail-tugas', [DetailTugasController::class, 'store'])->name('detail.store');
Route::delete('/detail-tugas/{id_detail_tugas}', [DetailTugasController::class, 'destroy'])->name('detail.delete');