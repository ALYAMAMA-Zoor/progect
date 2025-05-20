<?php
namespace App\Http\Controllers\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Notifications\Notification;
use App\Http\Requests\ResetRequest;
use App\Http\Controllers\Controller;
use App\Services\UserServices;
use App\Trait\responseTrait;
use App\Services\cacheService;

class ResetPasswordController extends Controller
{
   use responseTrait;
    public function __construct(
      protected UserServices $service,
      protected cacheService $cacheService,
    ){}
    public function resetpassword(ResetRequest $request)
    {    
     $status= $this->service->ResetPassword($request);

      $this->cacheService->putInCasheThree($request->toke);
       $this->cacheService->putInCasheFour($request->toke);


   return $status===Password::RESET_LINK_SENT
    ?$this->responseTraitOnlyMessage('failed to send link ,please try again',401)
    :$this->responseTraitOnlyMessage('go and check your email');
   
    }
}

