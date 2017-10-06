<?php
namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function getIndex() {
    $posts = Post::all();
    return view('index', ['posts' => $posts]);
  }


  /**
   * @return string
   */
  public function getAbout() {
    return "mystring";
  }
}