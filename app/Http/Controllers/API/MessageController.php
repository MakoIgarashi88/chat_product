<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageCreated;
use App\Message;
use App\Http\Resources\Message as MessageResource;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $messages = Message::where('group_id', $request->group_id)->get();
        return MessageResource::collection($messages);
    }

    public function private($friend_id)
    {
        $message_ids = [];
        $submit_messages = Message::where('user_id', Auth::id())->where('submit_user_id', $friend_id)->get();
        $resive_messages = Message::where('user_id', $friend_id)->where('submit_user_id', Auth::id())->get();
        foreach ($submit_messages as $message) {
            array_push($message_ids, $message->id);
        }
        foreach ($resive_messages as $message) {
            array_push($message_ids, $message->id);
        }
        $messages = Message::whereIn('id', $message_ids)->get();
        return MessageResource::collection($messages);
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
            logger($request);
            $message = new Message;
            $message->user_id = Auth::user()->id;
            $message->group_id = $request->group_id;
            $message->body = $request->body;
            $message->save();
            event(new MessageCreated($message));
        });

        return response()->json([
            'result' => true,
        ]);
    }

    public function privateStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $message = new Message;
            $message->user_id = Auth::user()->id;
            $message->submit_user_id = $request->friend_id;
            $message->body = $request->body;
            $message->save();
            event(new MessageCreated($message));
        });
    }
}
