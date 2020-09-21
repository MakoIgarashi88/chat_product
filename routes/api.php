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

// 認証なし
// group
Route::get('group', 'API\GroupController@index');
Route::get('group/{group_id}', 'API\GroupController@show');
Route::post('group', 'API\GroupController@store');

// 認証あり
Route::middleware(['auth:api'])->group(function () {
    Route::get('user/list', 'API\UserController@index');

    // message
    Route::get('message', 'API\MessageController@index');
    Route::post('message', 'API\MessageController@store');
});