<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Topic;

use App\Http\Resources\Topic as TopicResource;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        return response()->json(TopicResource::collection($topics));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $topic = new Topic;
            $topic->id     = $request->id;
            $topic->name   = $request->name;
            $topic->detail = $request->detail;
            $topic->save();
        });
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        return new TopicResource($topic);
    }
}
