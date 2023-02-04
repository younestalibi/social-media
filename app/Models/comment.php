<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\profiles;
use App\Models\post;

class comment extends Model
{
    use HasFactory;
    public function post(){
        return $this->belongsTo(post::class);
    }
    public function user(){
        return $this->belongsTo(user::class);
    }
}
