<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Micropost; # 追加

class Micropost extends Model
{
  /**
    * 投稿データを所有するユーザを取得
    */
    public function user()
    {
      return $this->belongsTo('App\User');
    }

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
     'user_id',
     'content',
   ];

     /**
    * 投稿データを降順で全て取得
    */
    public static function getAll()
    {
      $microposts = Micropost::all()->sortByDesc('id');
      return $microposts;
    }
 }
