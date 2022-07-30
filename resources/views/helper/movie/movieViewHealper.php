<?php

namespace resources\views\helper\movie;


use Illuminate\Http\Request;
use App\Helper\Movie\MovieHealper;

class MovieViewHealper
{
    // 「評価を編集」押下時 → 評価登録へ飛ばす
    // 「詳細」押下時 → 詳細へ飛ばす
    public function submitButtonManager(Request $request){
        if(isset($_POST['evaluation'])){
            return redirect() -> route('movie-evaluation');
        }elseif(isset($_POST['detail'])){
            return redirect() -> route('movie-detail');
        }
    }

    // 見たフラグの出し分け
    public function watchFlagManager($watchFlag){
        $watchResalt = MovieHealper::$MOVIE_WATCH_ARRAY[$watchFlag];
        return $watchResalt;   
    }

    // 評価推移
    public function evaluationTransitionManager($evaluation = 0, $publicEvaluation = 0){
        die;
        if($publicEvaluation > $evaluation){
            //下向き矢印
        }elseif($publicEvaluation < $evaluation){
            //上向き矢印
        }else{
            //並行矢印
        }
    }




}