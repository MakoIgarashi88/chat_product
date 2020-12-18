<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Board as BoardResource;

use App\Board;

class BoardController extends Controller
{
    public function update(Request $request)
    {
        $board = DB::transaction(function () use ($request) {
            $board = Board::where('user_id', Auth::id())->first();
            if ($request->name) {
                $board->name = $request->name;
            }
            if ($request->detail) {
                $board->detail = $request->detail;
            }
            $board->save();
            return $board;
        });
        
        return new BoardResource($board);
    }

}
