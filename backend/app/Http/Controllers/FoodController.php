<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFoodRequest;
use Illuminate\Http\Request;
use App\Food;

class FoodController extends Controller
{
    //function to get foods
    public function search($search){
        $food = Food::where('name', 'LIKE', '%'.$search.'%')->get();;
        return response()->json([
            "foods"=>$food
        ]);
    }
    //function to find food by id
    function get($id){
        $food = Food::where('id',$id)->get();
        return response()->json([
            "food"=>$food
        ]);
    }
    //function to store the food
    public function store(AddFoodRequest $request){
        $food = new Food;
        $food->name = $request->name;
        $food->calories = $request->calories;
        $food->amount = $request->amount;
        $food->protein = $request->protein;
        $food->carbs = $request->carbs;
        $food->fat = $request->fat;
        $food->save();
    }
}
