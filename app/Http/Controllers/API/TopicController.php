<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Topic;
use App\Image;
use App\FavoriteTopic;

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
        $topic = DB::transaction(function () use ($request) {
            $topic = new Topic;
            $topic->id     = $request->id;
            $topic->name   = $request->name;
            $topic->detail = $request->detail;
            $image_id      = Image::store($request->upload_image);
            if ($image_id) {
                $topic->image_id = $image_id;
            }
            $topic->save();
            return $topic;
        });
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        return new TopicResource($topic);
    }

    public function favorite()
    {
        $topics = [];
        $user = Auth::user();
        foreach ($user->topics as $topic) {
            array_push($topics,$topic);
        }
        return TopicResource::collection($topics);
    }
}
