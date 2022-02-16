<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostReactionRequest;
use App\Http\Resources\PostResource;
use App\Models\Like;
use App\Models\Post;
use App\Services\Post\Post as PostService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    use ApiResponser;
    
    public function list()
    {
        try {
            $posts = Post::get();  //eagerload in model
            return PostResource::collection($posts);
        }
        catch (Exception $e) {
            return $this->apiExceptionResponse($e);
        }
    }
    
    public function toggleReaction(PostReactionRequest $request)
    {
        
        try {
            $post = Post::findOrFail($request->post_id); 
            if($post->user_id == auth()->id()) {
                return $this->errorResponse("You cannot like your post",500);
            }
            $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();
            if($like && $like->post_id == $request->post_id && $request->like) {
                
                return $this->errorResponse('You already like this post',500);
                
            }
            elseif($like && $like->post_id == $request->post_id && !$request->like) {
                
                (new PostService())->unLike($like);
                return $this->successResponse('You unlike this post successfully');
            }
            
                (new PostService())->setLike($request->post_id);
            return $this->successResponse(null,"You Succesfully like the post");
            
        } catch (ModelNotFoundException $e) {
            return $this->apiExceptionResponse($e);
        }
        
    }
    
    
}
