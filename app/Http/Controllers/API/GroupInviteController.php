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
}
