<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //CRUD Operations

    public function create(Request $request){

        $movie = new Movie();
        $movie->title = $request->title;
        $movie->poster_url = $request->poster_url;
        $movie->synopsis = $request->synopsis;
        $movie->video_url = $request->video_url;
        $movie->year = $request->year;
        $movie->director_id = 1;
        $movie->category_id = 1;

        if($movie->save()){
            return response()->json(["success"=>true, "data"=>$movie ]);
        }

    }

    public function get(Request $request){
        $movies = Movie::get();
        return response()->json(["success"=>true,"data"=>$movies]);

    }

    public function getById(Request $request, $id){
        $movies = Movie::find($id);
        return response()->json(["success"=>true,"data"=>$movies]);
    }

    public function update(Request $request, $id){
        
        if ($movie){
            //this line requires you to add fillable property in Movie model
            $updated = $movie->fill($request->all())->save();

            if($updated){
                return response()->json(["success"=>true,"data"=>$movie]);
            }else{
                return response()->json(["success"=>false,"message"=>"Cannot Save"]);
            }
        }else{
            return response()->json(["success"=>false, "message"=>"Movie not found"]);
        }
    }

    public function delete(Request $request, $id){
        $movie = Movie::find($id);

        if($movie){
            if($movie->delete()){
                return response()->json(["success"=>true, "message"=>"Delete Success"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Delete Failed"]);
            }
        }else{
            return response()->json(["success"=>false, "message"=>"Movie not found"]);
        }
    }
}
