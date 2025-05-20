<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\likeRequest;
use App\Services\UserServices;
use App\Trait\responseTrait;
use App\Services\cacheService;

class likeController extends Controller
{
    use responseTrait;
    public function __construct(
        protected UserServices $service,
        protected cacheService $cacheService,
     ){}
    public function likePodcast(likeRequest $request,$id){
      
   $like= $this->service->like($request,$id);

    $this->cacheService->putInCasheTow($like, now()->addMinutes(10));

     return  $this->successResponse('your like added successfully',$like);
   }
   
   public function deletelike(likeRequest $request,$id){
    
    $this->service->deletelike($request,$id);
    
    return  $this->responseTraitOnlyMessage('your like deleted successfully');

}}
