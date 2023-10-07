<?php

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

Route::group(['namespace'=>'Api'],function (){
    Route::post('register','RegisterController@register');
    Route::post('login','LoginController@login');

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'],function (){
   Route::get('export-excel','ProductController@export');
   Route::post('import-excel','ProductController@import');

   Route::get('get-api','ThirdPartyApiController@index');
});

Route::group(['namespace'=>'Api'],function (){
    Route::post('create/products','ProductController@store')->middleware('auth:sanctum');
    Route::put('update/products/{id}','ProductController@update')->middleware('auth:sanctum');
    Route::delete('delete/products/{id}','ProductController@destroy')->middleware('auth:sanctum');
});


Route::get('send-email','Api\EmailController@send')->middleware('auth:sanctum');


