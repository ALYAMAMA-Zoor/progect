<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Podcast extends Model
{
    use HasFactory;
    protected $fillable= ['title', 'description', 'file_path', 'cover_image', 'user_id','chanels_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsToMany(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function channel(){
        return $this->belongsTo(chanel::class);
    }

}

