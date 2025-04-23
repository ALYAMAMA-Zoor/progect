<?php
namespace App\Services;
use App\Mdels\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class generateService{

 static   public function generateService($length=6){
        $user =Auth::user();
      return  $str=Str::random(6);
       $code =$user->two_factor_code;
      $codee=  $user->two_factor_expires_at=now()->addMinutes(1);
        $user->save();
    }
    
    public function generateServiceVerification($user){
         $ver= Str::random(6);
       
        $user->verification_code=$ver;
        $user->code_expires_at=now()->addMinutes(1);
         return $user->verification_code;
        
    }
    
   

    
}