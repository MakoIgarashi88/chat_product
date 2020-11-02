<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\GroupUserForList as GroupUserForListResource;
use App\Http\Resources\UserFriendForList as UserFriendForListResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!isset($user->id)) {
            $user = User::find(Auth::id());
        }
        logger($user->group_users);
        return response()->json([
            'user' => new UserResource($user),
            'friends' => UserFriendForListResource::collection($user->user_friends),
            'groups' => GroupUserForListResource::collection($user->group_users)
        ]);
        return $user;
    }

}
