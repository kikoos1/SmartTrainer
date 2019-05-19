<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use Auth;
use App\User;
use App\Events\FriendRequest;

class FriendController extends Controller
{
    //
    public function get(){
        $friends = Auth::user()->friends()->latest()->get();
        return response()->json([
            "friends"=>$friends
        ]);
    }
    public function search($search){
        $users = User::where('name','LIKE','%'.$search.'%')->get();
        return response()->json([
            "users"=>$users
        ]);
    }
    public function store(Request $request){
        $friend  = new Friend;
        $friend->user_id = Auth::user()->id;
        $friend->friend_id = $request->user_id;
        $friend->is_friends = 0;
        $friend->save();
        broadcast(new FriendRequest(Auth::user()->name, $request->user_id))->toOthers();
    }
    public function requests(){
        $fr_requests = Friend::where('friend_id',Auth::user()->id)->where('is_friends',0)->with('user')->latest()->get();
        return response()->json([
            "requests"=>$fr_requests
        ]);
    }
    public function patch(Request $request){
        $accept = Friend::find($request->id);
        $accept->is_friends = 1;
        $accept->save();
    }
    public function delete($id){
        $delete = Friend::find($id);
        $delete->delete();
    }
}
