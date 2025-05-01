<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use App\Services\UserServices;
use App\Http\Requests\categoryRequest;

class categoryController extends Controller
{
  
    public function __construct(
        protected UserServices $service,
     ){}
    public function category(categoryRequest $request){
      
     return  $this->service->category($request);
    }
    public function cat(categoryRequest $request,$id){

   $this->service->cat($request,$id);

    }
 }