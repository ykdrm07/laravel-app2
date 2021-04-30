<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micropost; # 追加
use Auth; # 追加
use App\Http\Requests\MicropostRequest; # 追加

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

 /**
   * 投稿フォーム表示アクション
   */
  public function input()
  {
    return view('micropost.input');
  }

    /**
   * 投稿処理アクション
   */
  public function post(MicropostRequest $request)
  {
    $content    = $request->input('content');
    $micropost  = new Micropost;
    $params = [
      'user_id' => Auth::id(),
      'content' => $content,
    ];
    if (!$micropost->micropostSave($params)) {
      // 登録失敗
      return redirect()->route('micropost.input')->with('error_message', 'Regist micropost failed');
    }
    return redirect()->route('micropost.index')->with('flash_message', 'regist success!!');
  }
 
}