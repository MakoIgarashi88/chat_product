<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            $company = new Message;
            $company->user_id = Auth::user()->id;
            $company->group_id = $request->group_id;
            $company->body = $request->body;
            $company->save();
        });

        return response()->json([
            'result' => true,
        ]);
    }
}
