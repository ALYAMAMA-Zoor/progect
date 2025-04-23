<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserServices;
use App\Http\Requests\LoginRequest;
use App\Trait\responseTrait;
use App\Services\cacheService;
use App\Services\generateService;


class LoginController extends Controller
{
   use responseTrait;
   public function __construct(
      protected UserServices $service,
      protected cacheService $cacheService,
      protected generateService $generateService,
     
   ){}
   
     function login(LoginRequest $request)
    {
      $this->service->login($request);

     $token = $this->service->createTokenByEmail($request->only('email'));
     
      $code= $this->generateService->generateService();  

      $this->cacheService->putInCashe($request->input('email'),$code);
      
     return $this->successWithToken('login successfully',$token,201);
     
    }
}
