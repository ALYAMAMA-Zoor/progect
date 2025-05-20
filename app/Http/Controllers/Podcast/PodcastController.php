<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\PodcastRequest;
use App\Services\UserServices;
use App\Trait\responseTrait;
use Illuminate\Http\Request;
use App\Services\cacheService;

class PodcastController extends Controller
{
    use responseTrait;
    public function __construct(
        protected UserServices $service,
        
         protected cacheService $cacheService,

     ){}
    public function store(PodcastRequest $request){
    
     $podcast= $this->service->podcast($request);

     $this->cacheService->putInCasheTow($podcast, now()->addMinutes(10));

    return  $this->responseTraitOnlyMessage('your bodcast added successfully');
    
    }
   
    public function randomPodcast(Request $request){ 
         
     return $this->service->random($request);

    }


    public function filterPodcast(Request $request){ 

     return $this->service->filter($request);

    }
   
}
