<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartureController extends Controller
{
    public function create(Request $request){
        $departure=new Departure();
        $departure->title=$request->title;
        $departure->save();
    }
}
