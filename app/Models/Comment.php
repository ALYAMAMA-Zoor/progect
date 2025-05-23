<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Comment extends Model
{
    use HasFactory;
    protected $fillable= ['body', 'user_id', 'podcast_id', 'parent_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function podcast(){
        return $this->belongsTo(Podcast::class);
    }
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

}
