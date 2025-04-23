<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendVerificationRequest;
use App\Models\User;
use App\Services\UserServices;
use App\Trait\responseTrait;
use App\Services\generateService;

class ResendVerificationController extends Controller
{
    use responseTrait;
    public function __construct(
       protected UserServices $service,
       protected generateService $generateService,
    ){}
     function resendVerification(ResendVerificationRequest $request){
       
      $this->service->UserResend($request); 

      $verification= $this->generateService->generateServiceVerification($request);

  /*  Mail::to($user->email)->send(new VerificationEmail($verificationCode));*/

      return $this->ResponseTraitResend($verification);

}
}
