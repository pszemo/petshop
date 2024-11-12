<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/pet/{id}', [PetController::class, 'show']);
Route::post('/pet', [PetController::class, 'store']);
Route::put('/pet/{id}', [PetController::class, 'update']);
Route::delete('/pet/{id}', [PetController::class, 'destroy']);
