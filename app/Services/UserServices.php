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
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\PodcastCategory;
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
  
        Podcast::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'file_path'=>$request->file_path,
            'publish_at'=>$request->publish_at,
            'channel_id'=>$request->channel_id,
            'user_id'=>$request->user_id,
           'cover_image'=>null,
        ]);
        if($request->has('categories')){
            $podcast->categories()->sync($request->input('categories'));
        }
}

////////////////////////////
public function random($request){
  
    $rand = $request->query('rand',1);
    return Podcast::inRandomOrder()->take($rand)->get();

}
////////////////////////////
public function filter($request){
    $query=Podcast::query();
        if($request->has('category')){
            $query->whereHas('categories',function ($q) use ($request){
                $q->where('category_id',$request->category);
            });
        }
        if($request->has('sort')){
            $query->orderBy($request->sort);
        }else{
            $query->orderBy('created_at');
        }
        return $query->paginate(5);

}
///////////////////////////
public function comment( $request,Podcast $podcast){
   
    $comment =new Comment([
        'body'=>$request->body,
        'user_id'=>$request->user_id,
        'podcast_id'=>$request->podcast_id,
        'parent_id'=>$request->Parent_id,
    ]);
    $comment->save();
}

//////////////////////////////////
public function category( $request){
   
  $category=  Category::firstOrCreate([ 
        'name'=>$request->name,
   ]);
   return $category;
}
public function cat( $request,$id){
   
    $cat= PodcastCategory::create([
        'podcast_id'=>$id,
        'category_id'=>$request->category_id,
    ]);
  }

//////////////////////////////////
public function like( $request,$id){
    $like =Like::firstOrCreate([
        'podcast_id'=>$id,
       'user_id'=>$request->user_id,
    ]);
    return $like;
    
}
public function deletelike($request,$id){

                                    
}

}
