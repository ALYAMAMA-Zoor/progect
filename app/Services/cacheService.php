<?php
namespace App\Services;
use Illuminate\Support\Facades\Cache;

class cacheService{

public function putInCashe($key, $value){
    Cache::put('verfiy code'.$key,$value);
}

}