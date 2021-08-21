<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Validator;
class PostController extends Controller
{
    public function creatPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["status"=>"error","errors"=>$validator->errors()]);
        }
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
        return response()->json(["status"=>"success","data"=>$post]);
    }
    public function getPosts(){
        $posts= Post::all();
        return response()->json(["data"=>$posts]);
    }
}
