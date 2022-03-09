<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Actor;

class ActorController extends Controller
{
    //

    public function create(Request $request){
        $actor = new Actor();
        $actor->name = $request->name;
        $actor->pic_url = $request->pic_url;
        $actor->dob = $request->dob;
    
        if($actor->save()){
            return response()->json(["success"=>true, "data"=>$actor ]);
        }

    }

    public function getAll(Request $request){
        //choose certain columns
        $actors = Actor::select(['id', 'name', 'pic_url', 'dob'])->get();
        return response()->json(["success"=>true,"data"=>$actors]);
    }

    public function getById(Request $request, $id){
        $actor = Actor::find($id);
        return response()->json(["success"=>true,"data"=>$actor]);
    }

    public function update(Request $request, $id){

        $actor = Actor::find($id);
        if ($actor){
            //this line requires you to add fillable property in Movie model
            $updated = $actor->fill($request->all())->save();

            if($updated){
                return response()->json(["success"=>true,"data"=>$actor]);
            }else{
                return response()->json(["success"=>false,"message"=>"Cannot Save"]);
            }
        }else{
            return response()->json(["success"=>false, "message"=>"Movie not found"]);
        }
    }

    public function delete(Request $request, $id){
        $actor = Actor::find($id);

        if($actor){
            if($actor->delete()){
                return response()->json(["success"=>true, "message"=>"Delete Success"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Delete Failed"]);
            }
        }else{
            return response()->json(["success"=>false, "message"=>"Movie not found"]);
        }
    }
}
