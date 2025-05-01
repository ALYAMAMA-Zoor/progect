<?php

namespace App\Http\Controllers\Podcast;

use App\Http\Controllers\Controller;
use App\Services\UserServices;
use App\Http\Requests\addCommentRequest;
use App\Models\Podcast;
use App\Trait\responseTrait;
use App\Models\Comment;


class addCommentPodcast extends Controller
{
    use responseTrait;
    public function __construct(
        protected UserServices $service,
     ){}
    public function addComment(addcommentRequest $request,Podcast $podcast){

        $this->service->comment($request, $podcast,);

        return  $this->responseTraitOnlyMessage('your comment added successfully');

    }
    public function index($id){
        $comments = Comment::with('replies')->where('podcast_id',$id)->whereNull('parent_id')->get();
       return  response()->json($comments);
    }
}
