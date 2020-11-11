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

Route::middleware(['auth:api'])->group(function () {
    // user
    Route::get('user/list', 'API\UserController@index');
    Route::get('user', 'API\UserController@show');
    Route::get('user/{user}', 'API\UserController@show');
    Route::put('user', 'API\UserController@update');

    // message
    Route::get('message', 'API\MessageController@index');
    Route::get('message/{user_id}', 'API\MessageController@private');
    Route::post('message', 'API\MessageController@store');
    Route::post('message/private', 'API\MessageController@privateStore');

    // group
    Route::get('group', 'API\GroupController@index');
    Route::get('group/{group_id}', 'API\GroupController@show');
    Route::post('group/{group_id}', 'API\GroupController@add');
    Route::post('group', 'API\GroupController@store');
    Route::put('group/edit', 'API\GroupController@update');
    Route::get('group/list/{group_id}', 'API\GroupController@list');
    Route::delete('group/leave/{group_id}', 'API\GroupController@destroy');    

    // friend
    Route::get('friend/search/{search_name}', 'API\UserController@search');
    Route::post('friend/add/', 'API\UserController@add');
    Route::get('friend/invite/list/{group_id}', 'API\UserController@invite');
    Route::get('friend/{user_id}', 'API\UserController@friendshow');

    // invite
    Route::get('invite/', 'API\InviteController@index');
    Route::post('invite/', 'API\InviteController@store');
    Route::delete('invite/{id}', 'API\InviteController@destroy');

    // image
    Route::post('image/', 'API\ImageController@store');
});
