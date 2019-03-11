<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    //
    public function find($search){
        $exercises = Exercise::where('name','like','%'.$search.'%')->get();
        return response()->json([
            'exercises'=>$exercises
        ],200);
    }
    public function get($id){
        $exercise = Exercise::find($id);
        return response()->json([
            'exercise'=>$exercise
        ]);
    }
    public function store(Request $request){
        $exercise = new Exercise();
        $exercise->name = $request->name;
        $exercise->save();
    }

}
