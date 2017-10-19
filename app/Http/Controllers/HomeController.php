<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('home');
  }


  public function getPostslist() {
    $data = array();
    $posts = Post::all()->sortBy('public');

    $data['posts'] = $posts;
    return view('admin.postsList', $data);
  }

  public function publicPost(Request $request, $id) {

    $post = Post::findOrFail($id);
    $post->public = !$post->public;
    $post->save();
    return redirect(route('postslist'));
  }
}
