<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix'=>'v1'],function(){
//     Route::post('/register',[ApiController::class,'register']);
//     Route::post('/login','ApiController@login');

    
// });


 Route::namespace('App\Http\Controllers')->group(function () {
       Route::group(['prefix'=>'v1'],function(){
            Route::post('/register',[ApiController::class,'register']);
            Route::post('/login',[ApiController::class,'login']);
         });

         Route::group(['middleware'=>'Jwt_Auth'],function(){
           
         });
    });


Route::fallback(function(){
    return response()->json([
        'status'    => false,
        'message'   => 'Page Not Found.',
    ], 404);
});
