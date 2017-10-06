<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;

class PostsController extends Controller
{

  /**
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function getPost($id) {
    $data = array();
    $post = Post::where('id', $id)->first();

    $data['post'] = $post;
    $data['author'] = $post->user;
    $data['theme'] = $post->theme;
    $data['like'] = Cookie::has('post_' . $id) ? 'active' : '';
    $response = view('posts.post', ['data' => $data]);

    if(!Cookie::has('post_view_' . $id)){
      $post->update(['views' => $post->views += 1]);
      $response = response($response)->cookie('post_view_' . $id, 'one_more');
    }

    return $response;
  }


  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function getPostForm() {
    $post = new Post();
    return view('posts.createPost', ['post' => $post]);
  }

  /**
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function editPost($id) {
    $post = Post::where('id', $id)->first();
    return view('posts.editPost', ['post' => $post]);
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function update(Request $request, $id) {
    $post = Post::findOrNew($id);

    $theme_title = $request->input('theme_id');
    $theme = Theme::where('title', $theme_title)->first();
    if (!$theme) {
      $theme = Theme::create(['title' => $theme_title]);
    }

    $request->merge(['author_id' => Auth::user()->id, 'theme_id' => $theme->id]);

    if ($request->hasFile('image')) {
      $file_name = $this->resize($request);
      $post->update(['image' => $file_name]);
    }
    $post->update($request->except('image'));
    return redirect(route('post', ['post' => $post]));

  }


  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(Request $request) {
    $theme_title = $request->input('theme_id');
    $theme = Theme::where('title', $theme_title)->first();
      if (!$theme) {
        $theme = Theme::create(['title' => $theme_title]);
      }

    $request->merge(['author_id' => Auth::user()->id, 'theme_id' => $theme->id]);
    $data = $request->all();
    $post = Post::create($data);

    if ($request->hasFile('image')) {
      Storage::delete('/public/images/' . $post->image);
      $file_name = $this->resize($request);
      // save new image $file_name to database
      $post->update(['image' => $file_name]);
    }

    return redirect(route('post', ['post' => $post]));
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @return string
   */
  public function resize(Request $request){
    $file_name = $request->file('image')->hashName();

    $path = '/images/big/'. $file_name;
    $image = Image::make($request->file('image'))->fit(720, 480)->stream();
    Storage::disk('public')->put($path, $image);


    $path = '/images/medium/'. $file_name;
    $image = Image::make($request->file('image'))->fit(280, 210)->stream();
    Storage::disk('public')->put($path, $image);

    return $file_name;
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function delete(Request $request, $id) {
    $post = Post::findOrFail($id);
    Storage::delete('/public/images/' . $post->image);

    $post->delete();
    return redirect('/');
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param $id
   * @return mixed
   */
  public function likePost(Request $request, $id){
    $post = Post::find($id);
    $cookie = $request->cookie('post_' . $id);
    if($cookie){
      $post->update(['votes' => $post->votes -= 1]);
      $response = response('dislike')->cookie(Cookie::forget('post_' . $id));
    }
    else{
      $post->update(['votes' => $post->votes += 1]);
      $response = response('like')->cookie('post_' . $id, 'like', 50000);
    }

    return $response;
  }

}
