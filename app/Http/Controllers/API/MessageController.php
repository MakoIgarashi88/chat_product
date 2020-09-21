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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
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
}
