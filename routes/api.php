<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PageController;
use App\Models\Person;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// public routes

Route::post('/auth/register', [RegisterController::class, 'register']);
Route::post('/auth/login', [RegisterController::class, 'login']);



// protected routes

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/person/attach-post', [PersonController::class, 'attach_post']);
    Route::post('/page/{pageId}/attach-post', [PageController::class, 'attach_post']);

    Route::post('/page/create', [PageController::class, 'store']);
});









Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



