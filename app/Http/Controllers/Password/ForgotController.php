<?php

namespace App\Http\Controllers\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Mail\ResetPassworEmail;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ForgotRequest;
use App\Services\UserServices;
use App\Trait\responseTrait;

class ForgotController extends Controller
{
  use responseTrait;
  public function __construct(
    protected UserServices $service,
 ){}
     function sendResetLinkEmail(ForgotRequest $request){

    $status=$this->service->ResetPasswordAndSend($request);

    return $status === Password::PASSWORD_RESET
    ?$this->resetTrait('password reset successfully')
    :$this->resetTrait('failed to reset password',401);

    }

}
