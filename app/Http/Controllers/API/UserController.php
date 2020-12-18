<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserFriend;
use App\GroupUser;
use App\Image;
use App\Board;
use App\BoardMessage;
use App\GroupInvite;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Board as BoardResource;
use App\Http\Resources\Friend as FriendResource;
use App\Http\Resources\Group as GroupResource;
use App\Http\Resources\GroupUserForList as GroupUserForListResource;
use App\Http\Resources\UserFriendForList as UserFriendForListResource;
use App\Http\Resources\BoardMessage as BoardMessageResource;

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
            $detail = Board::where('user_id', Auth::id())->first();
            $messages = BoardMessage::where('board_id', Auth::id())->get();
        }
        return response()->json([
            'user' => new UserResource($user),
            'friends' => UserResource::collection($user->friends),
            'groups' => GroupResource::collection($user->groups),
            'detail' => new BoardResource($detail),
            'messages' => BoardMessageResource::collection($messages),
            ]);
    }

    public function update(Request $request)
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::find($request->id);
            $user->nickname = $request->nickname;
            $user->detail = $request->detail;
            if($request->upload_image) {
                $image_id = Image::store($request->upload_image);
                if ($image_id) {
                    $user->image_id = $image_id;
                }
            }
            $user->save();
            Image::destroy(true);
            return $user;
        });

        return new UserResource($user);
    }

    public function search($search_name)
    {
        $friend =User::where('name', $search_name)->first();
        return $friend;
    }

    public function add(Request $request)
    {
        $friend_id = $request->friend_id;
        $message = '';
        $user_friend = UserFriend::where('user_id', Auth::id())->where('friend_id', $friend_id)->get();
        if (count($user_friend)) {
            logger($user_friend);
            $message = '既に友だちにになっています。';
        } else {
            $user_friend = new UserFriend;
            $user_friend->user_id = Auth::id();
            $user_friend->friend_id = $friend_id;
            $user_friend->save();
        }

        return response()->json([
            'message' => $message
        ]);
    }
    public function invite($id)
    {
        $friends = [];
        $group_user_ids = [];
        $group_users = GroupUser::where('group_id', $id)->get();
        foreach($group_users as $group_user) {
            $group_user_id = $group_user->user_id;
            array_push($group_user_ids, $group_user_id);
        }


        $user_friends = UserFriend::where('user_id', Auth::id())->whereNotIn('friend_id',$group_user_ids)->get();
        foreach ($user_friends as $user_friend) {
            $friend = User::find($user_friend->friend_id);
            array_push($friends, $friend);
        }
        return $friends;
    }

    public function friendshow($id)
    {
        $friend = User::where('id', $id)->first();
        $detail = Board::where('user_id', $id)->first();
        $messages = BoardMessage::where('board_id', $id)->get();
        return response()->json([
            'user' => new FriendResource($friend),
            'detail' => new BoardResource($detail),
            'messages' => BoardMessageResource::collection($messages),
            ]);
    }
}