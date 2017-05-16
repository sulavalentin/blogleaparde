<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;
/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts=Post::paginate(5);
        return view('frontend.index',['posts'=>$posts]);
    }
    public function post($id)
    {
        $post=Post::where("id","=",$id)->first();
        return view('frontend.post',['post'=>$post]);
    }
    public function addcomment(Request $request){
        /*get data from ajax*/
        $comment_text=$request->comment;
        $id=$request->id;
        /*save comment*/
        $comment=new Comment;
        $comment->user_id=Auth::id();
        $comment->post_id=$id;
        $comment->comment=$comment_text;
        $comment->save();
    }
    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
