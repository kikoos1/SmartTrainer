<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use Illuminate\Http\Request;
use App\Notification;
use Auth;

class NotificationController extends Controller
{
    //
    public function get(){
        $notification  = Notification::get();
        return response()->json([
           "notifications"=>$notification
        ]);
    }
    public function store(NotificationRequest $request){
        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->name = $request->name;
        $notification->time = $request->time;
        $notification->desc = $request->desc;
        $notification->save();
    }
}
