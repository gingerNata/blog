<?php
namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function getIndex() {
    $posts = array();
    $raw_posts = Post::all()->sortByDesc('created_at')->where('public', 1);

    foreach ($raw_posts as $i => $post){
      switch ($i%4){
        case 0: $posts[1][] = $post; break;
        case 1: $posts[2][] = $post; break;
        case 2: $posts[3][] = $post; break;
        case 3: $posts[4][] = $post; break;
      }
    }

    return view('index', ['posts' => $posts]);
  }


  /**
   * @return string
   */
  public function getAbout() {
    return "mystring";
  }
}