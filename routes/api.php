<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::post('user/register',[UserController::class,'register'])->name('user.register');
Route::post('user/login',[UserController::class,'login'])->name('user.login');


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('students', StudentApiController::class);
    Route::post('user/logout',[UserController::class,'logout'])->name('user.logout');
});
