<?php

namespace App\Http\Controllers\Profiles;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller {
  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function profile() {

    if(!Auth::user()){
      return redirect('/login');
    }
    $posts = Controller::reorderPosts(Auth::user()->posts);
    return view('profiles.profile', ['user' => Auth::user(), 'posts' => $posts, 'allow' => true]);
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function updateAvatar(Request $request) {

    if ($request->hasFile('avatar')) {
      $avatar = $request->file('avatar');
      $filename = time() . '.' . $avatar->getClientOriginalExtension();
      Image::make($avatar)
        ->resize(100, 100)
        ->save(public_path('/storage/avatars/' . $filename));

      $user = Auth::user();
      if ($user->avatar != 'default.png') {
        Storage::delete('/public/avatars/' . $user->avatar);
      }
      $user->avatar = $filename;
      $user->save();

      return view('profiles.profile', ['user' => $user]);
    }
    else
      return redirect()->route('profile');
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function delete(Request $request) {
    $user = Auth::user();
    $user->delete();

    return redirect('/login');
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function editProfile(){
    $user = Auth::user();
    
    return view('profiles.editProfile', ['user' => Auth::user()]);
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function updateData(Request $request){

    $user = Auth::user();

    if (!empty($request->input('name'))){
      $user->name = $request->input('name');
      $user->save();
    }
    if (!empty($request->input('email'))){
      $user->email = $request->input('email');
      $user->save();
    }
    if (!empty($request->input('about'))){
      $user->about = $request->input('about');
      $user->save();
    }

    return redirect()->route('profile');
  }

  /**
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function authorPage($id){
    $user = User::find($id);
    if (!$user){
      return view('errors.404');
    }
    $allow = FALSE;
    if(Auth::user() && (Auth::user() == $user || Auth::user()->id == 2)){
      $allow = True;
    }
    $posts = Controller::reorderPosts($user->posts->sortByDesc('created_at')->where('public', 1));
    return view('profiles.profile', ['user' => $user, 'posts' => $posts, 'allow' => $allow]);

  }

}
