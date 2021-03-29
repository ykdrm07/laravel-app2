<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostController extends Controller
{
  
  /**
   * 投稿一覧表示アクション
   */
  public function index()
  {
    return view('micropost.index');
  }
}