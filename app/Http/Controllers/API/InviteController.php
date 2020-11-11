<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Group;
use App\Invite;

class InviteController extends Controller
{
    public function index()
    {
        $letters = [];

        $invites = Invite::where('friend_id', Auth::id())->get();
        foreach($invites as $invite) {
            $user = User::find($invite->user_id);
            $group = Group::find($invite->group_id);
            $letter = [
                'id' => $invite->id,
                'friend_id' => $user->id,
                'friend_name' => $user->nickname,
                'group_id' => $group->id,
                'group_name' => $group->name,
            ];
            array_push($letters, $letter);
        }

        return $letters;

    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user_id = Auth::id();
            $friend_ids = $request->friend_ids;
            $group_id = $request->group_id;

            foreach ($friend_ids as $friend_id) {
                $invite = new Invite;
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
        logger($id);
        Invite::find($id)->delete();
    }
}
