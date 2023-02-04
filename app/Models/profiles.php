<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class profiles extends Model
{
    protected $fillable = [
        'image',
        'user_id',
        'full_name',
        'link',
        'description',
    ];

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
