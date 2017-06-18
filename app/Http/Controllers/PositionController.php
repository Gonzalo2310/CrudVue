<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
class PositionController extends Controller
{
    public function create(Request $request){
        $position=new Position();
        $position->title=$request->title;
        $position->departure_id=$request->departure;
        $position->save();
    }
    public function delete($id){
        Position::find($id)->delete();
    }

   public function update(Request $request){
        $position=Position::find($request->id);
        $position->title=$request->title;
        $position->departure_id=$request->departure;
         $position->save();
    }
}
