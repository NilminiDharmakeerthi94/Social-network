<?php
namespace App\Http\Controllers;
use App\Post;
use App\Like;
use App\User;
use Illuminate\Http\Request;
//use App\Http\Controllers\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller{

    public function getDashboad(){
        $posts= Post::orderBy('created_at','desc')->get();
        return view('dashboad', ['posts'=>$posts]);
    }

    public function postCreate(Request $request){
       // return redirect()->route('dashboad');
        
        $this->validate($request,[
        'body'=>'required|max:1000'                   //validation
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
      if( $request->user()->posts()->save($post)){
          $message = 'Post successfully created!';
      }
        return redirect()->route('dashboad')->with(['message'=> $message]);
       

    }
    public function getDeletePost($post_id){
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboad')->with(['message'=>'Successfully deleted!']);
    }
    public function getLogout(){
        Auth:: logout();
        return redirect()->route('home');
    }
    public function postEditPost(Request $request){
        $this->validate($request, [
            'body'=>'required'
        ]);
        $post = Post::find($request['postId']);
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->body=$request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body],200);
    }
    public function postLikePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true' ;
        $update = false;
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id',$post_id)->first();
        if($like){
            $already_like = $like->like;
            $update = true;
            if($already_like ==$is_like){
                $like->delete();
                return null;
            }}
            else{
                $like = new Like();
            }
            $like->like = $is_like;
            $like->user_id = $user->id;
            $like->post_id = $post->id;
       if($update){
           $like->update();
       }
       else{
           $like->save();
       }
       return null;
        }


    }
