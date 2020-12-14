<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Board;

class BoardController extends Controller
{
    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $board = Board::where('user_id', Auth::id())->first();
            $board->name = $request->name;
            $board->detail = $request->detail;
            $board->save();
        });
    }

}
