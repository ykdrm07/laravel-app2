<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micropost; # 追加

class MicropostController extends Controller
{
  
 /**
  * 投稿一覧表示アクション
  */
  public function index()
 {
   $microposts = Micropost::getAll();
   $viewParams = [
     'microposts' => $microposts,
   ];
   return view('micropost.index', $viewParams);
 }
}