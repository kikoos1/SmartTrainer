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

    public function get()
    {
        $user = Auth::user();
        $meals = Meal::with('food')->where('user_id', $user->id)->where('created_at', '>=', Carbon::today())->get();
        return response()->json([
            'meals' => $meals

        ]);
    }
        public function store(Request $request){
            $meal = new Meal;
            $meal->user_id = Auth::user()->id;
            $meal->food_id = $request->id;
            $meal->amount = $request->amount;
            $meal->type = $request->type;
            $meal->save();

        }
}
