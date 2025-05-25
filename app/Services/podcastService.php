<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PodcastRequest;
use App\Models\Podcast;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\chanel;
use App\Models\PodcastCategory;
use App\Models\User;


class podcastService{
public function podcast($request){
  
        Podcast::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'file_path'=>$request->file_path,
            'publish_at'=>$request->publish_at,
            'channel_id'=>$request->channel_id,
            'user_id'=>$request->user_id,
           'cover_image'=>null,
        ]);
        if($request->has('categories')){
            $podcast->categories()->sync($request->input('categories'));
        }
}


public function random($request){
  
    $rand = $request->query('rand',1);
    return Podcast::inRandomOrder()->take($rand)->get();

}

public function filter($request){
    $query=Podcast::query();
        if($request->has('category')){
            $query->whereHas('categories',function ($q) use ($request){
                $q->where('category_id',$request->category);
            });
        }
        if($request->has('sort')){
            $query->orderBy($request->sort);
        }else{
            $query->orderBy('created_at');
        }
        return $query->paginate(5);

}

public function comment( $request,Podcast $podcast){
   
    $comment =new Comment([
        'body'=>$request->body,
        'user_id'=>$request->user_id,
        'podcast_id'=>$request->podcast_id,
        'parent_id'=>$request->Parent_id,
    ]);
    $comment->save();
}


public function category( $request){
   
  $category=  Category::firstOrCreate([ 
        'name'=>$request->name,
   ]);
   return $category;
}

public function cat( $request,$id){
   
    $cat= PodcastCategory::create([
        'podcast_id'=>$id,
        'category_id'=>$request->category_id,
    ]);
  }


public function like( $request,$id){
    $like =Like::firstOrCreate([
        'podcast_id'=>$id,
       'user_id'=>$request->user_id,
    ]);
    return $like;
    
}
public function deletelike($request,$id){

                                    
}

public function chanel($request){
       $ch= Chanel::create([
            'name'=>$request->name,
            'user_id'=>$request->user_id,
        ]);
}
public function removechanel($request){
     Chanel::where('name',$request->name)->where('user_id',$request->user_id)->delete();
}

public function search($request){
     Podcast::where($request->name)->get();
}
}
