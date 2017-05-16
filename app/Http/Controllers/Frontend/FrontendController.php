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
        /*select post*/
        $post=Post::where("id","=",$id)->first();
        /*select similar posts*/
        $similar=Post::where("id","<>",$id)->inRandomOrder()->take(6)->get();
        /*get comments with user name*/
        $comments=Comment::select('comments.*','users.first_name')
                ->where('comments.post_id','=',$id)
                ->where('comments.hidden','=',1)
                ->Join('users','users.id','=','comments.user_id')
                ->orderBy("id","desc")
                ->get();
        /*return*/
        return view("frontend.post",["post"=>$post,
                            "similar"=>$similar,
                            "comments"=>$comments]);
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
}
