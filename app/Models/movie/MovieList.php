<?php

namespace App\Models\movie;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class MovieList extends User
{

    /**
     * 一覧用に映画情報取得
     * @param id 会員ID
     */
    public function getMovieListForIndex($id) :object
    {
        $movieList = DB::table('movie_list')
                    ->leftjoin('movie_users', 'movie_list.user_id', '=', 'movie_users.id')
                    ->select(
                        'movie_list.id',                // 映画ID
                        'movie_list.movie_name',        // 映画タイトル
                        'movie_list.genre',             // ジャンル
                        'movie_list.evaluation',        // 自己評価
                        'movie_list.public_evaluation', // 世間評価
                        'movie_list.watch_flag',        // ウォッチフラグ
                        'movie_list.image_path',        // 画像
                        )
                    -> where('movie_users.id','=',$id)
                    ->get();

        return (object)[
            'movieList' => collect($movieList)
        ];
    }

    /**
     * 検索
     * @param id 会員ID
     */
    public function getMovieListForSearch($userId, $genre = null, $movie_name = null) :object
    {
        $movieList = DB::table('movie_list')
                    ->leftjoin('movie_users', 'movie_list.user_id', '=', 'movie_users.id')
                    ->select( 
                        'movie_list.id',                // 映画ID
                        'movie_list.movie_name',        // 映画タイトル
                        'movie_list.genre',             // ジャンル
                        'movie_list.evaluation',        // 自己評価
                        'movie_list.public_evaluation', // 世間評価
                        'movie_list.watch_flag',        // ウォッチフラグ
                        'movie_list.image_path',        // 画像
                        )
                    -> where('movie_users.id','=',$userId)
                    -> when(!is_null($genre), function($query) use($genre){
                        $query->where('genre', $genre);
                    })
                    -> when(!is_null($movie_name), function($query) use($movie_name){
                        $query->where('movie_name', 'like' , "%$movie_name%");
                    })
                    ->get();

        return (object)[
            'movieList' => collect($movieList)
        ];
    }

    /**
     * 映画IDをもとに紐づく映画情報取得
     * @param id 会員ID 
     * @return 
     */
    public function getMovieDetail($movieId) :object
    {
        $movieDetail = DB::table('movie_list')
                    ->select( 
                        'movie_list.id',                // ID
                        'movie_list.movie_name',        // 映画タイトル
                        'movie_list.genre',             // ジャンル
                        'movie_list.evaluation',        // 自己評価
                        'movie_list.public_evaluation', // 世間評価
                        'movie_list.watch_flag',        // ウォッチフラグ
                        'movie_list.image_path',        // 画像
                        )
                    -> where('movie_list.id','=',$movieId)
                    ->get();

        return (object)[
            'movieDetail' => collect($movieDetail)
        ];
    }

    /**
     * 映画情報登録
     * @param playerName プレイヤー名
     * @param shipNumber 隻番号
     * 
     */
    public function setMovieList($playerName, $shipNumber)
    {
        DB::table('player')->insert([
                'player_name' => $playerName,
                'ship_number' => $shipNumber
                ]);

        return;

    }

    /**
     * 映画情報削除
     * @param id 映画ID
     */
    public function deleteMovieList($id)
    {
        DB::table('movie_list') -> where('id','=',$id) -> delete();

        return;
    }






}
