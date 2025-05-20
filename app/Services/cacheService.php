<?php
namespace App\Services;
use Illuminate\Support\Facades\Cache;

class cacheService{

public function putInCashe($key, $value){
    Cache::put('verfiy code'.$key, $value);
}

public function putInCasheTow($key, $value, $time){
    Cache::put('user_'.$key, $value, $time);
}

public function putInCasheThree($key){
    Cache::get('password_reset_'.$key);
}

public function putInCasheFour($key){
    Cache::forget('password_reset_'.$key);
}

}