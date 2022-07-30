<?php

namespace App\Http\Controllers\movie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MovieLoginController extends Controller

{
    /**
     * ログイン用コントローラー
     * @return view 
     */
    public function index(){
        return view('movie.auth.movieLogin');
    }

    /**
     * ログイン処理
     * @param  credentials ログイン情報
     * @return View
     */
    public function authenticate(Request $request){

        $credentials = $request->only('email','password');

            // 入力されたアドレスがDBに登録済みのものか認証する
            if(Auth::guard('movie')->attempt($credentials)){
                // セッションIDの再発行
                $request->session()->regenerate();
                // 一覧にリダイレクト
                return redirect() -> route('movie-index');
            }
            
        return back()->withErrors([
            'message' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    /**
     * ログアウト処理
     * @param  request ユーザー情報
     * @return View
     */
    public function logout(Request $request){

        Auth::guard('movie')->logout();
        // セッションデータ削除
        $request->session()->invalidate();
        // CSRFトークンを再生成して、2重送信対策
        $request->session()->regenerateToken();

        return view('movie.auth.movieLogin');
    }



}