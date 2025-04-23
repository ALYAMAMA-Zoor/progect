<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Trait\responseTrait;
use App\Services\UserServices;
use App\Http\Requests\imageRequest;

class MediaController extends Controller
{
    use responseTrait;
    public function __construct(
        protected UserServices $service,
     ){}
   public function Media(imageRequest $request,$userId){
   
    $this->service->image($request,$userId);

    return $this->responseTraitOnlyMessage(['your image added successfully']);
    
}
}