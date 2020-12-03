<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Group;
use App\GroupUser;
use App\User;
use App\Invite;

use App\Http\Resources\Group as GroupResource;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GroupResource::collection(Auth::user()->groups);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    
    {
        $group = Group::find($id);
        return $group;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $group = new Group;
            $group->name = $request->name;
            $group->save();
            $group_users = new GroupUser;
            $group_users->group_id = $group->id;
            $group_users->user_id = Auth::id();
            $group_users->save();
        });

        return response()->json([
            'result' => true,
        ]);
    }

    public function list($id)
    {
        $group_users = GroupUser::where('group_id', $id)->get();
        $users = [];
        foreach($group_users as $group_user) {
            $user = User::find($group_user->user_id);
            array_push($users, $user);
        }
        return $users;
    }

    public function destroy($id)
    {
        $group_user = GroupUser::where('user_id', Auth::id())->where('group_id', $id)->first();
        $group_user->delete();
    }

    public function add($id)
    {
        DB::transaction(function () use ($id) {
            $group_user = new GroupUser;
            $group_user->group_id = $id;
            $group_user->user_id = Auth::id();
            $group_user->save();
            
            $invites = Invite::where('group_id', $id)->where('friend_id', Auth::id())->get();
            foreach($invites as $invite) {
                $invite->delete();
            }
        });
        return 'グループに参加しました';
    }

    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $group = Group::find($request->group_id);
            $group->name = $request->group_name;
            $group->save();
        });

        return '成功しました。';
    }
}
