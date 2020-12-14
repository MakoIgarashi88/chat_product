<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\PrivateMessage;

use App\Events\MessageCreated;
use App\Http\Resources\Message as MessageResource;

class PrivateMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  $friend_id
     * @return \Illuminate\Http\Response
     */
    public function index($friend_id)
    {
        $message_ids = [];
        $submit_messages = PrivateMessage::where('user_id', Auth::id())->where('friend_id', $friend_id)->get();
        $resive_messages = PrivateMessage::where('user_id', $friend_id)->where('friend_id', Auth::id())->get();
        foreach ($submit_messages as $message) {
            array_push($message_ids, $message->id);
        }
        foreach ($resive_messages as $message) {
            array_push($message_ids, $message->id);
        }
        $messages = PrivateMessage::whereIn('id', $message_ids)->get();
        return MessageResource::collection($messages);

    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $message = new PrivateMessage;
            $message->user_id = Auth::user()->id;
            $message->friend_id = $request->friend_id;
            $message->body = $request->body;
            $message->save();
            event(new MessageCreated($message));
        });
    }
}
