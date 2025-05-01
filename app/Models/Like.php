<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['podcast_id', 'user_id'];
   
    public function podcast(){
        return $this->belongsTo(Podcast::class);
    }
}
