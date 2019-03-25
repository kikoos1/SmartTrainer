<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;
use App\Food;
use Auth;
use Carbon\Carbon;

class MealController extends Controller
{
    //function to fetch the meals of the user

    public function get($date)
    {
        $user = Auth::user();
        $meals = Meal::with('food')->where('user_id', $user->id)->where('created_at', '=', Carbon::parse($date))->get();
        return response()->json([
            'meals' => $meals

        ]);
    }
    public function getMeal($id){
        $user = Auth::user();
        $meal = Meal::with('food')->where('user_id',$user->id)->where('id',$id)->get();
        return response()->json([
            'meal' => $meal

        ]);
    }
        public function store(Request $request){
            $meal = new Meal;
            $meal->user_id = Auth::user()->id;
            $meal->food_id = $request->id;
            $meal->amount = $request->amount;
            $meal->type = $request->type;
            $meal->created_at = $request->date;
            $meal->save();

        }
        public function patch(Request $request){
        $meal = Meal::find($request->id);
        $meal->amount = $request->amount;
        $meal->type = $request->type;
        $meal->save();
        }
        
        public function delete($id){
        $meal = Meal::find($id);
        $meal->delete();
        }
}
