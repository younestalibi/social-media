<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;
use App\Models\profiles;

class FollowController extends Controller
{
    //
    function follow(User $id){
        // dd('hlloe');
        auth()->user()->following()->toggle($id->profile);
        if(auth()->user()->following->contains($id->profile)){
            return 'Unfollw';
        }
        else{
            return 'Follow';
        }
    }
    
}
