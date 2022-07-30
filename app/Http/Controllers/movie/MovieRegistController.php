<?php

namespace App\Http\Controllers\movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieUserRegist;
use App\Models\movie\MovieUser;
use App\Helper\Movie\MovieHealper;


class MovieRegistController extends Controller

{
    protected $movieUser;
    /**
     * MovieRegistController constructor
     * @param MovieUser 会員情報
     */
    public function __construct(MovieUser $movieUser){
        $movieUser = new MovieUser();
        $this->movieUser = $movieUser;
    }

    /**
     * 会員登録処理
     * @param inputs 入力内容
     * @param rules バリデーションルール
     * @return view
     */
    public function create(){
        return view('movie.regist.movieRegister');
    }

    public function store(MovieUserRegist $request){

        // 年齢を1900-01-01の形に整形
        if($request->month < 10){
            $request->month = str_pad($request->month, 2,'0', STR_PAD_LEFT);
        }
        if($request->day < 10){
            $request->day = str_pad($request->day, 2, '0', STR_PAD_LEFT);
        }
        $birth = $request->year . '-' . $request->month . '-' . $request->day;

        // 性別を整形
        if($request->sex == MovieHealper::MOVIE_USER_SEX_MAN){
            $request->sex = MovieHealper::MOVIE_USER_SEX_MAN;
        }else{
            $request->sex = MovieHealper::MOVIE_USER_SEX_WOMAN;
        }

        $userInformation = array(
            'name'     => $request->name,
            'age'      => $birth,
            'sex'      => $request->sex,
            'email'    => $request->email,
            'password' => $request->password,
            'created_at' => date('Y-m-d H:i:s'),
        );

        // 登録処理
        $this->movieUser->setMovieUser($userInformation);
        
        // ログイン画面に遷移
        return redirect() -> route('movie-login') -> with('flash_message', '登録が完了しました。 ログインしてください。');;
    }

}