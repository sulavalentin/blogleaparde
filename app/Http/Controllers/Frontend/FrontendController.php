<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;
Use Session;
use App\Models\Access\User\User;
/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    public function getusername(){
        return view('frontend.auth.username');
    }
    public function postusername(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:users|max:191',
        ]);
        User::where('id','=',Session::get('username'))->update(['username'=>$request->username]);
        Session::forget('username');
        return redirect('/');
    }
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
        $similars=Post::where("id","<>",$id)->inRandomOrder()->take(6)->get();
        /*get comments with user name*/
        $comments=Comment::select('comments.*','users.username')
                ->where('comments.post_id','=',$id)
                ->where('comments.hidden','=',1)
                ->Join('users','users.id','=','comments.user_id')
                ->orderBy("id","desc")
                ->get();
        /*return*/
        return view("frontend.post",["post"=>$post,
                            "similars"=>$similars,
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
