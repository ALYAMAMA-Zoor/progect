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

class ResetPasswordController extends Controller
{
   use responseTrait;
    public function __construct(
       protected UserServices $service,
    ){}
    public function resetpassword(ResetRequest $request)
    {    
     $status= $this->service->ResetPassword($request);

   return $status===Password::RESET_LINK_SENT
    ?$this->responseTraitOnlyMessage('failed to send link ,please try again',401)
    :$this->responseTraitOnlyMessage('go and check your email');
   
    }
}

