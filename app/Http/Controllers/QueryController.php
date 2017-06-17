<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departure;
class QueryController extends Controller
{
    public function allQuery(Request $request){
        if (!$request->ajax()) return redirect('/');
        return [
            'departures'=>Departure::all()
        ];
    }
}
