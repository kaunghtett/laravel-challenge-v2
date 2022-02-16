<?php

namespace App\Services\Post;

use App\Models\Like;

class Post 
{
   
    public function setLike(int $post_id) : bool
    {
        Like::create([
            'post_id' => $post_id,
            'user_id' => auth()->id()
        ]);

        return true;
    }
    
    public function unLike($like) : bool
    {
       $like->delete();
       
        return true;
    }
}