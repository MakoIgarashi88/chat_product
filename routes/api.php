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

    // board message
    Route::get('board/message', 'API\BoardMessageController@index');
    Route::get('board/message/{user_id}', 'API\BoardMessageController@show');
    Route::post('board/message', 'API\BoardMessageController@store');    
    Route::delete('board/message/{message_id}', 'API\BoardMessageController@destroy');    

    // private message
    Route::get('private/message/{friend_id}', 'API\PrivateMessageController@index');
    Route::post('private/message', 'API\PrivateMessageController@store');

    // group message
    Route::get('group/message/{group_id}', 'API\GroupMessageController@index');
    Route::post('group/message', 'API\GroupMessageController@store');

    // group
    Route::get('group', 'API\GroupController@index');
    Route::post('group', 'API\GroupController@store');
    Route::get('group/member/{group_id}', 'API\GroupController@memberList');
    Route::delete('group/leave/{group_id}', 'API\GroupController@leave'); 
    Route::put('group/edit', 'API\GroupController@update');

    Route::post('group/invite', 'API\GroupInviteController@store');
    Route::get('group/invite/{group_id}', 'API\GroupInviteController@show');
    Route::get('group/my/invite', 'API\GroupInviteController@index');
    Route::post('group/join', 'API\GroupController@join');
    Route::post('group/reject', 'API\GroupController@reject');

    Route::delete('group/delete/{group_id}', 'API\GroupController@destroy');
    Route::get('group/{group_id}', 'API\GroupController@show'); 

    // friend
    Route::get('friend/search/{search_name}', 'API\UserController@search');
    Route::post('friend/add', 'API\UserController@friendAdd');
    Route::get('friend/invite/list/{group_id}', 'API\UserController@invite');
    Route::get('friend/{user_id}', 'API\UserController@friendshow');

    // invite
    Route::get('invite', 'API\InviteController@index');
    Route::post('invite', 'API\InviteController@store');
    Route::delete('invite/{id}', 'API\InviteController@destroy');

    // image
    Route::post('image', 'API\ImageController@store');

    // topic
    Route::get('topic', 'API\TopicController@index');
    Route::get('topic/list', 'API\TopicController@alltopic');
    Route::post('topic', 'API\TopicController@store');
    Route::post('topic/detail', 'API\TopicController@update');
    Route::get('topic/favorite', 'API\TopicController@favorite');
    Route::post('topic/favorite', 'API\TopicController@favoriteChange');
    Route::post('topic/message', 'API\TopicController@messageUpload');
    Route::delete('topic/message/{message_id}', 'API\TopicController@destroy');
    Route::get('topic/{topic_id}', 'API\TopicController@show');

    // board
    Route::post('board', 'API\BoardController@update');
});
