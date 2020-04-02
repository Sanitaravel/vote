<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function showAll(){
        $vote = Vote::paginate(5);
        return view('index', ['votes' => $vote]);
    }

    public function create(Request $request){
        $vote = new Vote;
        $vote->title = $request->title;
        $vote->text = $request->text;
        $vote->positive = 0;
        $vote->negative = 0;
        $vote->save();

        return redirect('/');
    }

    public function showIndex($id){
        $vote = Vote::find($id);
        return view('show_vote', ['votes'=>$vote]);
    }

    public function increasePositive($id){
        $vote = Vote::find($id);
        $vote->positive++;
        $vote->save();
        return back();
    }

    public function increaseNegative($id){
        $vote = Vote::find($id);
        $vote->negative++;
        $vote->save();
        return back();
    }
}
