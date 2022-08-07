<?php

namespace App\Http\Controllers\movie;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\movie\MovieList;
use App\Models\movie\MovieUser;
use App\Http\Requests\MovieEvaluationRegist;
use App\Helper\Movie\MovieHealper;
use App\Resources\views\movie\MovieViewHealper;


class MovieController extends Controller

{

    protected $movieUser;
    protected $movieList;

    /**
     * constructor
     * @param MovieUser 会員情報
     * @param MovieList 映画情報
     */
    public function __construct(MovieUser $movieUser, MovieList $movieList){
        $movieUser = new MovieUser();
        $movieList = new MovieList();

        $this->movieUser = $movieUser;
        $this->movieList = $movieList;
    }


    /**
     * 一覧
     * @param 
     * @return view 
     */
    public function index(){
        // ログイン済みであれば一覧を表示
        if(Auth::guard('movie')->check()){
            $user_id = Auth::guard('movie')->user()->id;
            $objMovieList = $this->movieList->getMovieListForIndex($user_id);
                    app()->bind(MovieViewHealper::class, function () {
                        return new MovieViewHealper;
                    });
                    //$test = app()->make(MovieViewHealper::class);
                    //$tests = $test->watchFlagManager(0);
                    //var_dump($tests);
                    //die;
                    return view('movie.movieIndex' , [
                        'movieList' => $objMovieList,
                        'genreList' => MovieHealper::$MOVIE_GENRE_FANTASY_ARRAY,
                    ]);
            }
        // ログインしていなければログインページにリダイレクト
        return redirect() -> route('movie-login');

    }
    /**
     * 検索
     * @param 
     * @return view 
     */
    public function search(Request $request){
        // ログインユーザIDを取得
        $user_id = Auth::guard('movie')->user()->id;

        // 検索条件を取得
        $movieName = $request['movie_name'];
        $genre = $request['genre'];


        // 検索条件から映画情報を取得
        $objMovieList = $this->movieList->getMovieListForSearch($user_id, $genre, $movieName);
        if(isset($objMovieList)){
            return view('movie.movieIndex' , [
                'movieList' => $objMovieList,
                'genreList' => MovieHealper::$MOVIE_GENRE_FANTASY_ARRAY,
            ]);
        }
    }

    /**
     * 詳細
     * @param movieId 映画ID
     * @param movieDetail 映画詳細情報
     * @return view 
     */
    public function detail($movieId){
        // 映画IDで映画情報取得
        $objMovieList = $this->movieList->getMovieDetail($movieId);
        if(isset($objMovieList)){
            foreach($objMovieList->movieDetail as $value){
                $movieDetail = array(
                    'id' => $value->id,
                    'movieName'        => $value->movie_name,
                    'genre'            => $value->genre,
                    'evaluation'       => $value->evaluation,
                    'publicEvaluation' => $value->public_evaluation,
                    'watchFlag'        => $value->watch_flag,
                    'imagePath'        => $value->image_path,
                );
            }
        }
        return view('movie.movieDetail' , [
            'movieDetail' => $movieDetail,
        ]);
    }

    /**
     * 評価登録中継
     * @param id 映画ID
     * @return view 
     */
    public function evaluation($movieId){

        return view('movie.movieEdit', compact('movieId'));
    }

    /**
     * 評価登録
     * @param id 会員ID
     * @return view 
     */
    public function evaluationRegister(MovieEvaluationRegist $request){
        // 会員IDで映画情報取得
        $id = $request->id;

        $this->movieList->setMovieList($id, $movieDetail);



        return view('movie.movieEdit', compact('id'));
    }



}