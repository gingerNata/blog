<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;
use App\Post;
use App\Http\Controllers\Controller;

class ThemesController extends Controller
{
    public function getPostByTheme($theme_id){

      $theme = Theme::find($theme_id);
      if (!$theme){
        return view('errors.404');
      }
      $raw_posts = Post::where('theme_id', $theme_id)->get();
      $posts = $this->reorderPosts($raw_posts);
      $data = array();
      $data['posts'] = $posts;
      $data['theme_title'] = $theme->title;
      $data['count'] = Post::where('theme_id', $theme_id)->count();

      return view('posts.postByTheme', $data);
    }
}
