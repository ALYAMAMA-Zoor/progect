<?php
namespace App\Services;


use App\Mail\MyTestEmail;
use App\Mail\TwoFactorCodeMail;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Helper\ResponseHelper;
use App\Exceptions\InvalidOrderException;
use Illuminate\Http\Json\Response;
use Illuminate\Support\Arr;
use App\Http\Requests\RegisterRequest;
use App\Services\generateService;
use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PodcastRequest;
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
   // Mail::to($user->email)->send(new MyTestEmail($user));3
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
// Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));
   
}
public function UserResend($request)
{
 if(!auth()->attempt($request->only('email','password'))){
    throw new Exception('invali one');
 }
}



public function UserVerify( $request){
    
   if(!auth()->attempt($request->only('email','password','verification_code')))
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
}
public function image($request,$userId){
    $user=User::findOrFail($userId);
    $user->media()->create(['url'=>$request->url]);
}
public function podcast($request){
    $filePath = $request->file('file')->store('podcasts');
        $coverImagePath=null;
        if($request->hasFile('cover_image')){
            $coverImagePath=$request->file('cover_image')->store('covers');
        }
        Podcast::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'file_path'=>$filePath,
            'cover_image'=>$coverImagePath,
        ]);
}
public function comment($request,Podcast $podcast){
   
    $comment =new Comment([
        'body'=>$request->body,
        'user_id'=>auth()->id(),
        'podcast_id'=>$podcast->id(),
        'parent_id'=>$request->parent_id,
    ]);
    $comment->save();
}


}
