<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;

class FriendController extends Controller
{
    //
    public function get(){
        $friends = Friend::where('is_friends',1)->latest()->get();
        return response()->json([
            "friends"=>$friends
        ]);
    }
    public function store(Request $request){
        $friend  = new Friend;
        $friend 
    }
}
