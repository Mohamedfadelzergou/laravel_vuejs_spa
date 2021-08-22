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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::Post('creatPost','PostController@creatPost');
Route::get('getPosts','PostController@getPosts');
Route::put('updatePost/{postid}','PostController@updatePost');
Route::delete('deletePost/{postid}','PostController@deletePost');
Route::Post('register','UserController@register');
Route::Post('login','UserController@login');
