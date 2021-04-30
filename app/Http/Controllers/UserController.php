<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests\UserRequest; # 追加

use App\User; # 追加
use Hash; # 追加

class UserController extends Controller
{

    public function signin()
    {
        return view('user.signin');
    }

     /**
  * ログイン処理アクション
  */
  public function login(UserRequest $request)
  {
    $email    = $request->input('email');
    $password = $request->input('password');
    if (!Auth::attempt(['email' => $email, 'password' => $password])) {
      // 認証失敗
      return redirect('/')->with('error_message', 'I failed to login');
    }
    // 認証成功
    return redirect()->route('micropost.index');
  }

   /**
  * ログアウト処理アクション
  */
 public function logout()
 {
   Auth::logout();
   return redirect()->route('user.signin');
 }

  /**
   * ユーザ登録ページ表示アクション
   */
  public function create()
  {
    return view('user.create');
  }

 /**
  * ユーザ登録処理アクション
  */
  
  public function store(UserRequest $request)
  {
    $user     = new User;
    $name     = $request->input('name');
    $email    = $request->input('email');
    $password = $request->input('password');
    $params   = [
      'name'      => $name,
      'email'     => $email,
      'password'  => Hash::make($password),
    ];
    if (!$user->fill($params)->save()) {
      return redirect()->route('user.create')->with('error_message', 'User registration failed');
    }
    if (!Auth::attempt(['email' => $email, 'password' => $password])) {
      return redirect()->route('user.signin')->with('error_message', 'I failed to login');
    }
    return redirect()->route('micropost.index');
  }

 /**
  * ユーザ編集表示アクション
  */
  public function edit($id)
  {
    $user       = User::find($id);
    $viewParams = [
      'user' => $user,
    ];
    $this->authorize('view', $user); # 追加
    return view('user.edit', $viewParams);
  }

   /**
  * ユーザ更新アクション
  */
 public function update(UserRequest $request, $id)
 {
   $user     = User::find($id);
   $name     = $request->input('name');
   $email    = $request->input('email');
   $password = $request->input('password');
   $params   = [
     'name'      => $name,
     'email'     => $email,
     'password'  => Hash::make($password),
   ];
   $this->authorize('update', $user);
   if (!$user->userSave($params)) {
     // 更新失敗
     return redirect()
            ->route('user.edit', ['user' => $user->id])
            ->with('error_message', 'Update user failed');
   }
   return redirect()->route('micropost.index')->with('flash_message', 'update success!!');
 }

 /**
   * ユーザ一覧表示アクション
   */
  public function index()
  {
    $users = User::all();
    $viewParams = [
      'users' => $users,
    ];
    return view('user.index', $viewParams);
  }


   /**
   * ユーザ削除処理アクション
   */
  public function destroy($id)
  {
    $this->adminCheck();
    $user = User::find($id);
    if (!$user->delete()) {
      return redirect()->route('user.index')->with('error_message', 'Delete user failed');
    }
    return redirect()->route('user.index')->with('flash_message', 'delete success!!');
  }


  // private
 
  // ログインユーザが管理者であるかチェック
  private function adminCheck()
  {
    $adminFlg = Auth::user()->admin_flg;
    if (!$adminFlg) {
      abort(404);
    }
    return true;
  }
  
}
