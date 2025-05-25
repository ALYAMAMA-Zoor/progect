<?php
namespace App\Services;


use App\Mail\MyTestEmail;
use App\Mail\TwoFactorCodeMail;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Exceptions\InvalidOrderException;
use Illuminate\Http\Json\Response;
use Illuminate\Support\Arr;
use App\Services\generateService;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserServices{
public function UserRegister($request){  

    $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request['password']),
        'verification_code'=>generateService::generateService($request['str']),
        'two_factor_code'=>generateService::generateService($request['cod']),
        'two_factor_expires_at'=>generateService::generateService($request['code']),

    ]);
    return $user;
    Mail::to($user->email)->send(new MyTestEmail($user));
    }

public function login($request)
{ 
    $user= Auth::user();
    if(!auth()->attempt($request->only('email','password'))){
        throw new Exception('invali one');
    }
   
    if($request->two_factor_expires_at){
        $google2fa =app('pragmarx.google2fa'); 
        if(!$google2fa->verifyKey($user->two_factor_code, $request->two_factor_code)){
            throw new Exception('invali one');
        
    }}
    

}

public function createTokenByEmail($email){
  
    $user= User::where('email',$email)->FirstOrFail();
    $token= $user->createToken('auth_token')->plainTextToken; 
   return $token;
 Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));
   
}
public function UserResend($request)
{
 if(!auth()->attempt($request->only('email','password'))){
    throw new Exception('invali one');
 }
}



public function UserVerify( $request){
    
   if(!auth()->attempt($request->only('email','verification_code')))
   {
    throw new Exception('invali one');
   }
}



public function UserToken(){
   
    $user= Auth::guard('sanctum')->user();
    if(!$user){
        throw new Exception('invali one');
    }
    $user->createToken('Bearer')->plainTextToken;
    
}
public function image($request,$userId){
    $user=User::findOrFail($userId);
    $user->media()->create(['url'=>$request->url]);
}

}
