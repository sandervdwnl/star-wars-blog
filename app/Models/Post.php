<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'featured_image',
        'featured',
        'user_id',
        'author'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }


}
