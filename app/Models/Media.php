<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable=['url'];

    public function mediable(){

        return $this->morphTo();

    }
}
