<?php


 function ResponseHelperR($or,$user){
   return [
      'message'=>'user '.$or.' successfully,please check your email ',
      'User'=>$user
   ];
 
}
function ResponseHelperL($user,$token){
   return [
      'message'=>'Login successfully',
      'Two Factor'=>'Tow_Factor code sent to your email.',
      'User'=>$user,
      'Token'=>$token,
   ];
 
}
function ResponseHelperLI(){
   return[
     'message'=>'invalid email or password'
   ]
   ;
 
}
function ResponseHelperResend($verificationCode){
   return [
      'message'=> 'New VerificVation code sent...',
      'new verification'=>$verificationCode
   ];
 
}

function ResponseHelperVerfiy(){
   return [
     'message'=>'Email verified successfully'
   ];
 
}

 ?>