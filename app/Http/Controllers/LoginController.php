<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller


{
    /**
     * ログイン用コントローラー
     *
     * @return View
     */
    public function index(){

        return view('auth.login');
    }

    /**
     * ログイン処理
     *
     * @return View
     */
    public function authenticate(Request $request){

        $credentials = $request->only('email','password');

            // 入力されたアドレスがDBに登録済みのものか認証する
            if(Auth::attempt($credentials)){
                // セッションIDの再発行
                $request->session()->regenerate();
                // 指定の場所にリダイレクト
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            
        return back()->withErrors([
            'message' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    /**
     * ログアウト処理
     *
     * @return View
     */
    public function logout(Request $request){

        Auth::logout();
        // セッションデータ削除
        $request->session()->invalidate();
        // CSRFトークンを再生成して、2重送信対策
        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }

}