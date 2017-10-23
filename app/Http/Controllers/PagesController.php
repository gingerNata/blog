<?php
namespace App\Http\Controllers;

use App\Post;


class PagesController extends Controller {

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function getIndex() {
    $raw_posts = Post::all()->sortByDesc('created_at')->where('public', 1);
    $posts = Controller::reorderPosts($raw_posts);

    return view('index', ['posts' => $posts]);
  }


  /**
   * @return string
   */
  public function getAbout() {
    return "mystring";
  }
}