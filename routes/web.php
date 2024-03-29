<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InsightController;
use Illuminate\Routing\RouteGroup;

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

// login
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//beranda
Route::prefix('beranda')->group(function () {
    //index
    Route::get('/', [BerandaController::class, 'index']);
    //filter date
    Route::post('/', [BerandaController::class, 'index']);
});

//form
Route::prefix('form')->group(function () {
    Route::get('/', [FormController::class, 'index']);
    Route::post('/', [FormController::class, 'store']);
    Route::put('/{id}', [FormController::class, 'update']);
    Route::delete('/{id}', [FormController::class, 'destroy']);
});

//insight
Route::prefix('insight')->group(function () {
    //index
    Route::get('/', [InsightController::class, 'index']);
    //filter date
    Route::post('/', [InsightController::class, 'index']);
});
