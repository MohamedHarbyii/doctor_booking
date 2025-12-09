<?php


use App\Http\Controllers\Auth\AuthController ;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Services\DatabaseServices\PatientDB;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::controller(AuthController::class)->group(function() {
    Route::post('register','register');
    Route::post('login','login');
    Route::post('logout','logout')->middleware('auth:sanctum');
});
Route::controller(PatientController::class)->prefix('patient')->group(function() {
    Route::get('/','index');
    Route::get('/{patient}','show')->missing(function(){return 'not found';});
    Route::patch('/',"update");
    Route::delete('/','destroy');
});