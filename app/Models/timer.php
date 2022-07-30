<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class timer extends User
{

    /**
     * timer情報取得
     * @param playerId timerテーブルのplayer_id
     * 
     */
    public function getTimer($playerId) :object
    {
        $sql = DB::table('timer')
                    ->select('id', 'player_id', 'start_at', 'end_at')
                    ->where([
                        ['player_id', '=', $playerId],
                        ['deleted_flag', '=', 0]
                      ])
                    ->get();

        return (object)[
            'sql'=> collect($sql)
        ];
    }

    /**
     * timer情報登録
     * @param playerId timerテーブルのplayer_id
     * @param fromTime 現在日付
     * @param toTime 終了日付
     * 
     */
    public function setTimer($playerId, $fromTime, $toTime)
    {
        DB::table('timer')->insert([
                'player_id' => $playerId,
                'start_at' => $fromTime,
                'end_at' => $toTime
                ]);

        return;

    }

    /**
     * timer情報削除
     * @param playerId timerテーブルのplayer_id
     * 
     */
    public function deleteTimer($playerId)
    {
        DB::table('timer')->where('player_id','=',$playerId)->delete();

        return;

    }
}
