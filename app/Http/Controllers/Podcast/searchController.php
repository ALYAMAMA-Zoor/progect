<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Services\UserServices;
use App\Http\Requests\searchRequest;
class searchController extends Controller
{
        public function __construct(
        protected UserServices $service,
     ){}
    public function search(searchRequest $request){
    
          $this->service->search($request);
      
    }
}
