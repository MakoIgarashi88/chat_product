<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Topic;
use App\TopicMessage;
use App\Image;
use App\FavoriteTopic;

use App\Http\Resources\Topic as TopicResource;
use App\Http\Resources\TopicMessage as TopicMessageResource;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $query->where('tags', 'like', '%'.$tag.'%');
        // $topics = Topic::all();
        // $topic_messages = TopicMessage::orderBy('created_at', 'desc')->groupBy('topic_id')->limit(5)->get(['topic_id']);
        // '
        // select max(id)
        // from topic_messages
        // group by topic_id
        // '
        $topic_ids = TopicMessage::selectRaw('max(id) as id, topic_id')
            ->groupBy('topic_id')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get()
            ->pluck('topic_id');

        $topics = [];

        foreach ($topic_ids as $id) {
            array_push($topics, Topic::find($id));
        }

        return response()->json(TopicResource::collection($topics));
    }

    public function alltopic()
    {
        $topics = Topic::orderBy('id', 'desc')->get();
        return response()->json(TopicResource::collection($topics));
    }

    public function store(Request $request)
    {
        $topic = DB::transaction(function () use ($request) {
            $topic = new Topic;
            $topic->name   = $request->name;
            $topic->detail = $request->detail;
            $topic->tags   = json_encode($request->tags);
            $image_id      = Image::store($request->upload_image);
            if ($image_id) {
                $topic->image_id = $image_id;
            }
            $topic->save();
            Image::destroy(true);
            return $topic;
        });
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        $favorite = FavoriteTopic::where('user_id', Auth::id())->where('topic_id', $id)->get();
        $is_favorite = count($favorite) ? true : false;
        $messages = TopicMessage::where('topic_id', $id)->get();
        return response()->json([
            'topic' => new TopicResource($topic),
            'messages' => TopicMessageResource::collection($messages),
            'is_favorite' => $is_favorite,
            ]);
    }

    public function update(Request $request)
    {
        $topic = DB::transaction(function () use ($request) {
            $topic = Topic::where('id', $request->topic_id)->first();
            if ($request->name) {
                $topic->name = $request->name;
            }
            if ($request->detail) {
                $topic->detail = $request->detail;
            }
            if ($request->upload_image) {
                $image_id = Image::store($request->upload_image);
                if ($image_id) {
                    $topic->image_id = $image_id;
                }
            }
            if ($request->tags) {
                $topic->tags = json_encode($request->tags);
            }
            $topic->save();
            Image::destroy(true);
            return new TopicResource($topic);
        });
        return $topic;
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

    public function favoriteChange (Request $request)
    {
        if ($request->favorite) {
            //  登録作業;
            DB::transaction(function () use($request) {
                $favorite = new FavoriteTopic;
                $favorite->user_id = Auth::id();
                $favorite->topic_id = $request->topic_id;
                $favorite->save();
            });
            // $favorite = $request->favorite;
            // return $favorite;
        } else { // 削除作業
            $record = FavoriteTopic::where('user_id', Auth::id())->where('topic_id', $request->topic_id)->delete();
            // $favorite = $request->favorite;
            // return $favorite;
        };
    } 

    public function messageUpload(Request $request)
    {
        $message = DB::transaction(function () use ($request) {
            $message = new TopicMessage;
            $message->topic_id = $request->topic_id;
            $message->user_id  = Auth::id();
            $message->body     = $request->message;
            $message->save();
            return $message;
        });

        return new TopicMessageResource($message);
    }

    public function destroy ($message_id)
    {
        // logger($message_id);
        TopicMessage::find($message_id)->delete();
    }
}
