<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
///////////////////////////users///////////////////////////////////////////////////
Route::post('register', [AuthController::class, 'register']);

Route::post('change_password', [AuthController::class, 'change_password']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
Route::post('changepassword', [AuthController::class, 'changepassword']);
Route::post('resetpassword', [AuthController::class, 'resetpassword']);



Route::post('logout', [AuthController::class, 'logout']);

Route::post('details', [AuthController::class, 'details']);



//////////////////////API ////////////

/////////////////////Users////////////////////////////////

Route::prefix('users')->group(function () {
    Route::get('/AllUsers', [UserController::class, 'AllUsers']);
  
  
});


///////////////tasks //////////////////////////////////
use App\Http\Controllers\Api\TaskController;

Route::apiResource('task', TaskController::class);



