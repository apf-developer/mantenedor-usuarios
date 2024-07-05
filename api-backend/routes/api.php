<?php

use App\Http\Controllers\Api\Auth\AuthUserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rutas publicas
Route::post('register', [AuthUserController::class, 'register']);
Route::post('login', [AuthUserController::class, 'login']);

//Rutas protegidas
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthUserController::class, 'logout']);
    
    Route::get('users', [UsersController::class, 'index']);
    Route::get('users/show/{id}', [UsersController::class, 'show']);
    Route::delete('users/delete/{id}', [UsersController::class, 'destroy']);
    Route::patch('users/update/{id}', [UsersController::class, 'update']);

    Route::patch('users/profile/update', [ProfileController::class, 'updateNameEmail']);
    Route::patch('users/profile/update/password', [ProfileController::class, 'updatePassword']);
});
