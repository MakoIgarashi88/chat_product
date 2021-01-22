<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\BoardMessage;

use App\Http\Resources\BoardMessage as BoardMessageResource;

class BoardMessageController extends Controller
{
    public function index()
    {
        $messages = BoardMessage::where('board_id', Auth::id())->get();
        return BoardMessageResource::collection($messages);
    }

    public function store(Request $request)
    {
        $message = DB::transaction(function () use ($request) {
            $message = new BoardMessage;
            $message->user_id = Auth::user()->id;
            $message->board_id = $request->board_id;
            $message->body = $request->message;
            $message->save();
            return $message;
        });

        return new BoardMessageResource($message);
    }

    // public function show($id)
    // {
    //     $messages = BoardMessage::where('board_id', $id)->get();
    //     return BoardMessageResource::collection($messages);
    // }

    public function destroy ($message_id)
    {
        // logger($message_id);
        BoardMessage::find($message_id)->delete();
    }
}
