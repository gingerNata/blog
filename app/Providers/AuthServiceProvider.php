<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    'App\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot(GateContract $gate) {
    $this->registerPolicies();

    $gate->before(function ($user) {
      $roles = $user->roles;
      foreach ($roles as $role) {
        if ($role->id == 1) {
          return TRUE;
        }
      }
    });


    $gate->define('post-owner', function ($user, $post = null) {
      if ($post == null) return FALSE;
      return $user->id == $post->author_id;
    });
    
    $gate->define('admin', function ($user) {
      $roles = $user->roles;
      foreach ($roles as $role) {
        if ($role->id == 1) {
          return TRUE;
        }
      }
    });
    
  }
}
