<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    //
    public function find($search){
        $exercises = Exercise::where('name','like','%'.$search.'%');
        return response()->json([
            'exercises'=>$exercises
        ],200);
    }
    public function store(Request $request){
        $exercise = new Exercise();
        $exercise->name = $request->name;
        $exercise->save();
    }

}
