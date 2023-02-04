<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;
use App\Models\comment;
use App\Models\like;
use App\Events\UserOnline;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $followings=auth()->user()->following;
        $posts=[];
        foreach($followings as $following){
            foreach($following->user->post as $post){
                array_unshift($posts,$post);
            }
        }
        array_multisort($posts);
        $posts = array_reverse($posts);
        $users=User::all()->where('id','<>',auth()->user()->id);

        $comments=comment::all();
        $likes=like::where('id',auth()->user()->id)->get();
        $user=user::where('id',auth()->user()->id)->get();

        // set the statu of the user online after loggin
        $user=user::where('id',auth()->user()->id)->first();
        $user->status='Online';
        $user->save();


 
        return view('home',['posts'=>$posts,
        'user'=>$user,
        'users'=>$users,
        'follower'=>$followings,
        'comments'=>$comments,
        'likes'=>$likes,
        ]);
    }









    public function create_comment($id){
        $comment=new comment();
        $comment->post_id=$id;
        $comment->image=auth()->user()->profile->image;
        $comment->name=auth()->user()->profile->full_name;
        $comment->user_id=auth()->user()->profile->user_id;
        $comment->comment=request('target');
        $comment->save();
        return comment::where('post_id',$id)->get()->count();

    } 
    

    public function create_like($post_id){
        $aa=like::where('post_id',$post_id)->get()->count();
        if($likes=like::where('user_id',auth()->user()->id)
                    ->where('post_id',$post_id)
                    ->get()->first()){
            if($likes->user_id == auth()->user()->id){
                $likes->delete();
                return ['Like',like::where('post_id',$post_id)->get()->count()];
                
            }
        }else{
            $like=new like();
            $like->post_id=$post_id;
            $like->image=auth()->user()->profile->image;
            $like->name=auth()->user()->profile->full_name;
            $like->user_id=auth()->user()->profile->user_id;
            $like->save();
            return ['Dislike',like::where('post_id',$post_id)->get()->count()];
        }
        
        
    } 
    public function pop_up_post($post_id){
        $comments=post::where('id',$post_id)->get()->first()->comments;
        $likes=post::where('id',$post_id)->get()->first()->likes->count();
        return [$comments,$likes];
        
    }
    public function search($search){
        $result=user::where('user_name','like','%'.$search.'%')->get();
        return $result;
    }
}
