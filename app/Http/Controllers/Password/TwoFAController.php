<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\generateService;
use App\Services\UserServices;

class TwoFAController extends Controller
{
    public function __construct(
        protected UserServices $service,
        protected generateService $generateService,
       
     ){}
    public function enableTwoFactorAuthentication(Request $request){

        $this->service->twofa();

        $secret= $this->generateService->generateService();

        return response()->json(['secret'=>$secret]);

    }

}
