<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workout;
use  App\Http\Requests\WorkoutRequest;
use Auth;

class WorkoutController extends Controller
{
    //
    public function get(){
        $workouts = Workout::latest()->where('exercise_id',null)->get();
        return response()->json([
            "workouts"=>$workouts
        ]);
    }
    public function store(WorkoutRequest $request){
        $workout = new Workout;
        $workout->user_id = Auth::user()->id;
        $workout->created_at = $request->date;
        $workout->name = $request->name;
        $workout->save();
    }
    public function patch(Request $request){
        $workout = Workout::find($request->$id);
        $workout->name = $request->name;
        $workout->created_at = $request->date;
        if($request->kg){
        $workout->reps = $request->reps;
        $workout->sets = $request->sets;
        $workout->kg = $request->kg;
        }
        $workout->save();

    }
    public function delete($id){
        $workout = Workout::find($id);
        $workout->delete();
    }
    public function addexercise(Request $request){
        $workout = new Workout;
        $workout->exercise_id = $request->id;
        $workout->user_id = Auth::user()->id;
        $workout->workout_id = $request->workout_id;
        $workout->sets = $request->sets;
        $workout->reps = $request->reps;
        $workout->kg = $request->kg;
        $workout->save();
    }
    public function getexercises($id){
        $workout = Workout::where('workout_id',$id)->with('exercise')->latest()->get();
        return response()->json([
            "exercises" =>$workout
        ]);

    }
}
