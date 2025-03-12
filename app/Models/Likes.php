<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Likes extends Model
{
    //
    protected $fillable = ['user_id', 'post_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Posts::class);
    }
    public static function isLikedBy($post_id)
    {
        return self::where('user_id', Auth::user()->id)->where('post_id', $post_id)->exists();
    }
}
