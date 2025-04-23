<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PodcastRequest;
use App\Services\UserServices;
use App\Trait\responseTrait;
class PodcastController extends Controller
{
    use responseTrait;
    public function __construct(
        protected UserServices $service,
     ){}
    public function store(PodcastRequest $request){
    
    $this->service->podcast($request);
       
    return $this->responseTraitOnlyMessage('your bodcast added successfully');
    }
   
}
