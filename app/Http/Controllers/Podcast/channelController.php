<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chanel;
use App\Http\Requests\chanelRequest;
use App\Services\UserServices;
use App\Services\cacheService;

class channelController extends Controller
{
     public function __construct(
        protected UserServices $service,
         protected cacheService $cacheService,
     ){}
    public function createchannel(chanelRequest $request){
    
      $chanel= $this->service->chanel($request);

      $this->cacheService->putInCasheTow($chanel, now()->addMinutes(10));

    }
    public function removeChannel(chanelRequest $request){

       $this->service->removechanel($request);

    }
}
