<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;
use App\Models\profiles;
use App\Models\comment;
use App\Policies\ProfilePolicy;


class ProfileController extends Controller
{
    public function profile($id){
        $user=User::findorfail($id);
        $following=$user->following;
        $followers=$user->profile->followers;
        return view('profile',['user'=>$user,'following'=>$following,'followers'=>$followers]);
    }

    public function welcome($id){
        $user=User::findorfail($id);
        $following=$user->following;
        $followers=$user->profile->followers;
        return view('welcome',['user'=>$user,'following'=>$following,'followers'=>$followers]);
    }




    public function edite(User $id){
        $this->authorize("update",$id->profile);
        return view('edite',['user'=>$id]);
    }

    public function update(User $id){
        $this->authorize("update",$id->profile);
        $user=comment::where('user_id',$id->id)->get();
        foreach($user as $comment){
            $comment->image=$id->profile->image;
        }
        $data=request()->validate([
            'image'=>['image'],
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['string', 'max:255',],
            'link' => ['string'],
            'description' => ['string','max:255'],
            'email' => [ 'string', 'email', 'max:255', ],
        ]);
        if(request('image')){
            $path=public_path().'/storage/'.$id->profile->image;
            if (file_exists($path) and str_contains($path, '/storage/uploads/')) { 
                    unlink($path);
            } 
            $id->profile->image=request('image')->store('uploads','public');
            foreach($user as $comment){
                $comment->image=$id->profile->image;
                $comment->name=request('user_name');;
                $comment->save();

            }

        }
        $id->profile->user_id=auth()->user()->id;
        $id->profile->full_name=request('name');
        $id->name=request('name');
        $id->user_name=request('user_name');
        $id->profile->link=request('link');
        $id->profile->description=request('description');
        $id->email=request('email');
        $id->profile->save();
        $id->save();
        return redirect("/profile/$id->id");
    }
}
