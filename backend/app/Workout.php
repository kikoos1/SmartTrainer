<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exercise;

class Workout extends Model
{
    //
    public function exercise(){
        return $this->belongsTo(Exercise::class);
    }

}
