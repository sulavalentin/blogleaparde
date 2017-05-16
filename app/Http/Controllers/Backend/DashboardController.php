<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts=Post::orderBy("id","desc")->paginate(5);
        return view('backend.dashboard',["posts"=>$posts]);
    }
    public function newpost()
    {
        return view('backend.posts.index');
    }
    public function addpost(Request $request){
        $post=new Post;
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
    }
    /*edit function get post*/
    public function getedit($id){
        $post=Post::where("id","=",$id)->first();
        return view("backend.posts.editpost",["post"=>$post]);
    }
    public function postedit(Request $request){
        $post=Post::where("id","=",$request->id)->first();
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
    }
    /*delete function get post*/
    public function getdelete($id){
        $post=Post::where("id","=",$id)->first();
        return view("backend.posts.delete",["post"=>$post]);
    }
    public function postdelete($id){
        Post::where("id","=",$id)->delete();
        Comment::where("user_id","=",$id)->delete();
        return redirect("/admin");
    }
}
