<?php

namespace App\Http\Controllers;

use App\Http\Requests\KgRequest;
use Illuminate\Http\Request;
use App\Kg;
use Auth;

class KgController extends Controller
{
    //
    public function get(){
        $kg = Kg::get();
        return response()->json([
            'kg'=>$kg
        ]);
    }
    public function store(KgRequest $request){
        $kg = new Kg;
        $kg->kg = $request->kg;
        $kg->user_id = Auth::user()->id;
        $kg->created_at = $request->date;
        $kg->save();
    }
    public function patch(Request $request){
        $kg = KG::find($request->id);
        $kg->kg = $request->kg;
        $kg->created_at = $request->date;
        $kg->save();
    }
    public function delete($id){
        $kg = KG::find($id)->delete();
    }
}
