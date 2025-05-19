<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chanel;
use App\Http\Requests\chanelRequest;
use App\Services\UserServices;
class channelController extends Controller
{
     public function __construct(
        protected UserServices $service,
     ){}
    public function createchannel(chanelRequest $request){
    
       $this->service->chanel($request);

    }
    public function removeChannel(chanelRequest $request){

       $this->service->removechanel($request);

    }
}
