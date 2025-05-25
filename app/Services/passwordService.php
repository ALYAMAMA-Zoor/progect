<?php
namespace App\Services;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class passwordService{
public function ResetPassword($request){
    $status =Password::sendResetLink($request->only('email'));
   
}

public function ResetPasswordAndSend($request){
    $status=Password::reset($request->only('email','password','password_confirmation','token'),
    function($user, $password){
      $user->password=Hash::make($password);
      $user->save();
    }) ;
   
    return $status;
}
public function twofa(){
    $google2fa = app('pragmarx.google2fa');
    $secret = $google2fa->generateSecretKey();
}}