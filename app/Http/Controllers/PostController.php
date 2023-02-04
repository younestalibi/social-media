<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;


class PostController extends Controller
{
    //
    public function create(){
        return view('create');
    }
    public function store(){
        $data=request()->validate([
            'post'=>['required','image'],
            'description' => ['required', 'string', 'max:255']
        ]);

        $post=new post();
        $post->user_id=auth()->user()->id;
        $post->post=request('post')->store('posts','public');
        $post->description=request('description');
        $post->save();
        return redirect('/profile/'.$post->user->id);
    }
    public function show(post $post){
        return view('showpost',['post'=>$post]);
    }
}
