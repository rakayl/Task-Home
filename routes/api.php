<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['bearer'], 'namespace' => 'Modules\Transaction\Http\Controllers'], function () {
    Route::post('/deposit', [Controller::class, 'deposit']);
    Route::post('/withdrawal', [Controller::class, 'withdrawal']);
});
