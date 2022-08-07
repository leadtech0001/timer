<?php

namespace App\Resources\views\movie;


use App\Helper\Movie\MovieHealper;

class MovieViewHealper
{   
    // 見たフラグの出し分け
    public static function watchFlagManager($watchFlag){
        $watchResalt = MovieHealper::$MOVIE_WATCH_ARRAY[$watchFlag];
        return $watchResalt;   
    }

    // 評価推移
    public static function evaluationTransitionManager($evaluation = 0, $publicEvaluation = 0){
        if($publicEvaluation > $evaluation){
            // 下向き矢印
            $downArrow = 'movie/down.png';
            return $downArrow;
        }elseif($publicEvaluation < $evaluation){
            // 上向き矢印
            $upArrow = 'movie/up.png';
            return $upArrow;
        }else{
            // 並行矢印
            $parallelArrow = 'movie/parallel.png';
            return $parallelArrow;
        }
    }
    public static function test(){
        return print_r('あああ');
    }




}