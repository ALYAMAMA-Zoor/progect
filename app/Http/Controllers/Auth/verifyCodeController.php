<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\VerifyCodeRequest;
use App\Services\UserServices;
use App\Trait\responseTrait;
use App\Services\generateService;

class verifyCodeController extends Controller
{
   use responseTrait;
   public function __construct(
      protected UserServices $service,
      protected generateService $generateService,
   ){}

     function verifyCode(VerifyCodeRequest $request){

          $this->service->UserVerify($request);

          return $this->ResponseTraitVerifiy();
     }
}
