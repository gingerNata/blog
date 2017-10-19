<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;
use App\Post;

class ThemesController extends Controller
{
    public function getPostByTheme($theme_id){

      $theme = Theme::find($theme_id);
      $raw_posts = Post::where('theme_id', $theme_id)->get();
      $posts = array();
      foreach ($raw_posts as $i => $post){
        switch ($i%4){
          case 0: $posts[1][] = $post; break;
          case 1: $posts[2][] = $post; break;
          case 2: $posts[3][] = $post; break;
          case 3: $posts[4][] = $post; break;
        }
      }
      $data = array();
      $data['posts'] = $posts;
      $data['theme_title'] = $theme->title;
      $data['count'] = Post::where('theme_id', $theme_id)->count();

      return view('posts.postByTheme', $data);
    }
}
