<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;

class PostsController extends Controller
{

  /**
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function getPost(Request $request, $id) {
    $post = Post::where('id', $id)->first();
    if (!$post){
      return view('errors.404');
    }
    $data = array();
    $data['new_posts'] = $this->getNewPosts($id);
    $data['popular_posts'] = $this->getPopularPosts($id);
    $data['themes'] =  $this->getThemes();
    $data['post'] = $post;
    $data['author'] = $post->user;
    $data['theme'] = $post->theme;
    $data['like'] = Cookie::has('post_' . $id) ? 'active' : '';
    
    $response = view('posts.post', ['data' => $data]);

    $cookie = $request->cookie('post_view');
    $cookie = is_array($cookie) ? $cookie : array();

    if(!$cookie || !in_array($id, $cookie)){
      $cookie[] = (integer) $id;
      $response = response($response)->cookie('post_view',  $cookie);
      $post->update(['views' => $post->views += 1]);
    }

    return $response;
  }

  /**
   * @param $this_id
   * @return mixed
   */
  public function getNewPosts($this_id){
    return Post::where('id', '<>', $this_id)->orderBy('created_at', 'desc')->take(4)->get();
  }

  /**
   * @param $this_id
   * @return mixed
   */
  public function getPopularPosts($this_id){
    return Post::where('id', '<>', $this_id)->orderBy('votes', 'desc')->take(4)->get();
  }

  /**
   * @return array
   */
  public function getThemes(){
    $themes = array();
    $themes_raw = Theme::all();
    foreach ($themes_raw as $key => $theme){
      if(!$theme->post->isEmpty()){
        $themes[$key] = $theme;
        $themes[$key]['count'] = $theme->post->count();
      }
    }
    return $themes;
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

    if (Gate::denies('post-owner', $post)) {
      return redirect()->back();
    }


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
    $post->public = 0;
    $post->update($request->except('image'));
    return redirect(route('post', ['post' => $post]));

  }


  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(Request $request) {
    $rules = [
      'image' => 'required|image',
      'body' => 'required|min:300'
    ];
  $this->validate($request, $rules);

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
    $image = Image::make($request->file('image'))->fit(260, 180)->stream();
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
    if (Gate::denies('post-owner', $post)) {
      return redirect()->back();
    }

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
    $cookie = $request->cookie('post');
    if(is_array($cookie) && in_array($id,$cookie)){
      $post->update(['votes' => $post->votes -= 1]);
      $response = response('dislike')->cookie('post', array_diff($cookie, [$id]));
    }
    else{
      $cookie = is_array($cookie) ? $cookie : array();
      $post->update(['votes' => $post->votes += 1]);
      $cookie[] = $id;
      $response = response('like')->cookie('post', $cookie, 50000);
    }

    return $response;
  }

}
