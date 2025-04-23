<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\UserServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use  App\Trait\responseTrait;

class RegisterController extends Controller
{
    use responseTrait;

    public function __construct(
        protected UserServices $service,
    ){}

    function register(RegisterRequest $request)
    { 
       $user= $this->service->UserRegister($request);
       
       return $this->successResponse('register success',$user);
       
    }
}
