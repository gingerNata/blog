<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $raw_posts
     * @return array
     */
    public function reorderPosts($raw_posts){
        $posts = array();
        foreach ($raw_posts as $i => $post){
            switch ($i%4){
                case 0: $posts[1][] = $post; break;
                case 1: $posts[2][] = $post; break;
                case 2: $posts[3][] = $post; break;
                case 3: $posts[4][] = $post; break;
            }
        }
        return $posts;
    }
}
