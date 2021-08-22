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
        $posts= Post::paginate(3);
        return response()->json(["data"=>$posts]);
    }
    public function updatePost(Request $request,$postid){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["status"=>"error","errors"=>$validator->errors()]);
        }
        $post=Post::find($postid);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
        return response()->json(["status"=>"success","data"=>$post]);
    }
    public function deletePost($idpost){
        $post=Post::find($idpost);
        if($post->delete()){
        return response()->json(["status"=>"success","data"=>$post]);
        }
    }
}
