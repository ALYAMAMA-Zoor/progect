<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\likeRequest;
use App\Services\UserServices;
use App\Trait\responseTrait;


class likeController extends Controller
{
    use responseTrait;
    public function __construct(
        protected UserServices $service,
     ){}
    public function likePodcast(likeRequest $request,$id){
      
   $like= $this->service->like($request,$id);

     return  $this->successResponse('your like added successfully',$like);
   }
   
   public function deletelike(likeRequest $request,$id){
    
    $this->service->deletelike($request,$id);
    
    return  $this->responseTraitOnlyMessage('your like deleted successfully');

}}
