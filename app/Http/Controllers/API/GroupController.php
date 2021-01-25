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
use App\Image;
use App\GroupInvite;

use App\Http\Resources\Group as GroupResource;
use App\Http\Resources\User as UserResource;

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
        return new GroupResource($group);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_group = DB::transaction(function () use ($request) {
            $group = new Group;
            $group->name = $request->name;
            $group->detail = $request->detail;
            $image_id      = Image::store($request->upload_image);
            if ($image_id) {
                $group->image_id = $image_id;
            }
            $group->save();
            Image::destroy(true);

            $group_user = new GroupUser;
            $group_user->group_id = $group->id;
            $group_user->user_id = Auth::id();
            $group_user->save();

            foreach ($request->checked as $invite_id) {
                $group_invite = new GroupInvite;
                $group_invite->group_id = $group->id;
                $group_invite->friend_id = $invite_id;
                $group_invite->user_id = Auth::id();
                $group_invite->save();
            }
            return $group;
        });

        return response()->json([
            'result' => true,
            'new_group' => new GroupResource($new_group),
        ]);
    }

    public function memberList($id)
    {
        $group = Group::find($id);
        return UserResource::collection($group->members);
    }

    public function leave($id)
    {
        $group_user = GroupUser::where('user_id', Auth::id())->where('group_id', $id)->first();
        $group_user->delete();
    }

    public function join(Request $request)
    {
        $response = DB::transaction(function () use ($request) {
            $group_ids = array_unique($request->group_ids);
            foreach ($group_ids as $group_id) {
                $group_user = new GroupUser;
                $group_user->group_id = $group_id;
                $group_user->user_id = Auth::id();
                $group_user->save();

                $delete_invite_ids = [];
                $invites = GroupInvite::where('group_id', $group_id)->where('friend_id', Auth::id())->get();
                foreach ($invites as $invite) {
                    array_push($delete_invite_ids, $invite->id);
                    $invite->delete();
                }
            }
            $groups = Group::whereIn('id', $group_ids)->get();

            return [
                'delete_invite_ids' => $delete_invite_ids,
                'join_groups' => GroupResource::collection($groups),
            ];
        });

        return $response;
    }

    public function reject(Request $request)
    {
        $delete_invite_ids = DB::transaction(function () use ($request) {
            $delete_invite_ids = [];
            foreach ($request->group_ids as $group_id) {
                $invites = GroupInvite::where('group_id', $group_id)->where('friend_id', Auth::id())->get();
                foreach ($invites as $invite) {
                    array_push($delete_invite_ids, $invite->id);
                    $invite->delete();
                }
            }
            return $delete_invite_ids;
        });
        return [
            'delete_invite_ids' => $delete_invite_ids,
        ];
    }

    public function update(Request $request)
    {
        $group = DB::transaction(function () use ($request) {
            $group = Group::find($request->group_id);
            if ($request->group_name) {
                $group->name = $request->group_name;
            }
            if ($request->group_detail) {
                $group->detail = $request->group_detail;
            }
            if($request->group_image) {
                $image_id = Image::store($request->group_image);
                if ($image_id) {
                    $group->image_id = $image_id;
                }
            }
            $group->save();
            Image::destroy(true);
            return $group;
        });

        return new GroupResource($group);
    }

    public function inviteUser($id)
    {
        $member_ids = Group::find($id)->members->pluck('id');
        $invites = Auth::user()->friends->whereNotIn('id', $member_ids);

        return UserResource::collection($invites);
    }

    public function invite(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::id();
            $friend_ids = $request->invite_ids;
            $group_id = $request->group_id;

            foreach ($friend_ids as $friend_id) {
                $invite = new GroupInvite;
                $invite->user_id = $user_id;
                $invite->friend_id = $friend_id;
                $invite->group_id = $group_id;
                $invite->save();
            }
        });

        return '招待しました。';
    }

    public function destroy($id)
    {
        $group_invites = GroupInvite::where('group_id', $id)->get();
        foreach ($group_invites as $group_invite) {
            $group_invite->delete();
        }

        $group_users = GroupUser::where('group_id', $id)->get();
        foreach ($group_users as $group_user) {
            $group_user->delete();
        }

        $group = Group::find($id);
        $group->delete();
        return [
            'group_invite' => $group_invites,
            'group_users' => $group_users,
            'group' => $group,
        ];
    }

}
