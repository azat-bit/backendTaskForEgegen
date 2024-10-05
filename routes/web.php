<?php

use App\Http\Controllers\HaberlerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/haberler', [HaberlerController::class, 'store']);
// Haber silme rotası, 'check.token' middleware ile korunmuş
Route::delete('/haberler/{id}', [HaberlerController::class, 'destroy']);
