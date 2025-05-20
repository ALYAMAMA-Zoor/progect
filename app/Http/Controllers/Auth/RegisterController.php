<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\UserServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use  App\Trait\responseTrait;
use App\Services\cacheService;

class RegisterController extends Controller
{
    use responseTrait;

    public function __construct(
        protected UserServices $service,
        protected cacheService $cacheService,
    ){}

    function register(RegisterRequest $request)
    { 
       $user= $this->service->UserRegister($request);

       $this->cacheService->putInCasheTow($request->email, $user, now()->addMinutes(10));

       return $this->successResponse('register success',$user);
       
    }
}
