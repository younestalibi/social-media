<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserOnline;


class UserOnlineController extends Controller
{
    public function online (User $id) {
        if($id->status=='Offline'){
            $id->status='Online';
            $id->save();
        }        
        event(new UserOnline($id));
    }

    public function offline (User $id) {
        if($id->status=='Online'){
            $id->status='Offline';
            $id->save();
        }
        event(new UserOnline($id));
    }
}

