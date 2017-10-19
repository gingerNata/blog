<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
  protected $fillable = ['title', 'description', 'image'];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function post(){
    return $this->hasMany('App\Post', 'theme_id');
  }
}
