<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Group;
use App\Invite;
use App\GroupInvite;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\GroupInvite as GroupInviteResource;


class GroupInviteController extends Controller
{
    public function index()
    {
        $letters = [];

        $invites = GroupInvite::where('friend_id', Auth::id())->get();
        return GroupInviteResource::collection($invites);
    }

    public function destroy($id)
    {
        logger($id);
        Invite::find($id)->delete();
    }

    /**
     * 招待できる人の情報を取得
     */
    public function show($id)
    {
        $member_ids = Group::find($id)->members->pluck('id');
        $already_invite_ids = GroupInvite::where('group_id', $id)->where('user_id', Auth::id())->get()->pluck('friend_id');
        $invites = Auth::user()->friends->whereNotIn('id', $member_ids)->whereNotIn('id', $already_invite_ids);

        // logger('------------------------');
        // logger('メンバー' . $member_ids);
        // logger('------------------------');
        // logger('------------------------');
        // logger('既に招待されている人たち' . $already_invite_ids);
        // logger('------------------------');
        logger('------------------------');
        logger('招待したい人たち' . $invites);
        logger('------------------------');

        return UserResource::collection($invites);
    }

    /**
     * 招待する
     */
    public function store(Request $request)
    {
        $friend_ids = DB::transaction(function () use ($request) {
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
            return $friend_ids;
        });
        /**
         * $friends = 招待したフレンドの情報
         */
        $friends = User::whereIn('id', $friend_ids)->get();

        return UserResource::collection($friends);

    }
}
