<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class player extends User
{

    /**
     * 全player情報およびそれに紐づくtimer情報取得
     * 
     */
    public function getPlayer() :object
    {
        $sql = DB::table('player')
                    ->leftjoin('timer', 'player.id', '=', 'timer.player_id')
                    ->select( 
                        'player.id', 
                        'player.player_name', 
                        'player.ship_number', 
                        'timer.start_at', 
                        'timer.end_at'
                        )
                    ->where([
                        ['player.deleted_flag', '=', 0]
                      ])
                    ->get();

        return (object)[
            'sql'=> collect($sql)
        ];
    }

    /**
     * player情報登録
     * @param playerName プレイヤー名
     * @param shipNumber 隻番号
     * 
     */
    public function setPlayer($playerName, $shipNumber)
    {
        DB::table('player')->insert([
                'player_name' => $playerName,
                'ship_number' => $shipNumber
                ]);

        return;

    }

    /**
     * player情報削除
     * @param id プレイヤーID
     * 
     */
    public function deletePlayer($id)
    {
        DB::table('player')->where('id','=',$id)->delete();

        return;

    }






}
