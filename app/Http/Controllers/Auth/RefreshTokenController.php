<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Services\UserServices;
use App\Trait\responseTrait;

class RefreshTokenController extends Controller
{
    use responseTrait;
    public function __construct(
       protected UserServices $service,
      
    ){}
    public function refreshToken(Request $request){
      
       $this->service->UserToken($request);

       $token=$this->service->createTokenByEmail($request->only('email'));
       
       return $this->successWithToken('refresh successfully',$token,201);
    }

}
