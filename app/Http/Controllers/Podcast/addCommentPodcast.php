<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class addCommentPodcast extends Controller
{
    public function __construct(
        protected UserServices $service,
     ){}
    public function addComment(addcommentRequest $request,Podcast $podcast){

        $this->service->comment($request, $podcast);

        return $this->responseTraitOnlyMessage('your comment added successfully');

    }
}
