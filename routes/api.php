<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{LoginController,
                         HomeController,
                         RegisterController};


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(LoginController::class)
->prefix('/login')
->group(function(){
    Route::post('/', 'doLogin');
});

Route::controller(RegisterController::class)
->prefix('/register')
->group(function(){
    Route::post('/', 'doRegister');
});

Route::controller(RegisterController::class)
->prefix('/remember-password')
->group(function(){
    Route::post('/', 'doRememberPassword');
});


Route::controller(HomeController::class)
->prefix('/home')
->group(function(){
    Route::get('/users', 'searchUsers');
})->middleware('auth:sanctum');


Route::get('/address/search/{cep}', [RegisterController::class, 'findLocationByCep']);
