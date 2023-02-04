<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\profiles;
use App\Models\post;
use App\Models\like;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile(){
        return $this->hasOne(profiles::class);
    }
    public function post(){
        return $this->hasMany(post::class);
    }
    public function comments(){
        return $this->hasMany(comment::class);
    }
    public function likes(){
        return $this->hasMany(like::class);
    }
    public function following(){
        return $this->belongsToMany(profiles::class);
    }

    public static function boot() {
        parent::boot();
        static::created(function($user) {
           $user->profile()->create([
                'link'=>'N/A',
                'description'=>'N/A',
                'image'=>'default/avatar.jpg',
                'full_name'=>$user->name,
           ]);
        });
    }
}
