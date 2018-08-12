<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Achievement;
use Auth;

class AchievementController extends Controller
{
    //
    public function get($user_id){
        $achievements = Achievement::where('user_id',$user_id)->get()->latest();
        return response()->json([
            "achievement"=>$achievements
        ],200);

    }
    public function store(){
        $achievement = new Achievement;
        $achievement->user_id = Auth()->user()->id;

    }
}
