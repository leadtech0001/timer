<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\player;
use App\Models\timer;
use App\Models\User;
use App\Http\Requests\UserRegistPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DateTime;

class TimerController extends Controller


{
    protected $player;
    protected $timer;
    /**
     * TimerController constructor
     * @param player 全プレイヤー情報
     * @param timer 全タイマー情報
     * @return view
     */
    public function __construct(){
        $player = new player();
        $timer = new timer();
        $this->player = $player;
        $this->timer = $timer;

    }
    
    /**
     * スーパータイマー　一覧
     * @param playerData 全プレイヤー情報
     * @return view
     */
    public function index(){
        // ログイン状態を確認
        if(Auth::check()){
            // 全プレイヤー情報取得
            $objPlayerData = $this->player->getPlayer();


            if(isset($objPlayerData)){
                $PlayerData[] = array();
                foreach($objPlayerData->sql as $seq => $value){
                    $endFlag = 0;
                    // 現在日付とend_at(タイマー時間設定)との時間差を計算する
                    if(isset($objPlayerData->sql[$seq]->end_at)){
                        $endFlag = 1;
                    }
                    $fromTime = new DateTime();
                    $endTime = $objPlayerData->sql[$seq]->end_at;
                    $toTime = new DateTime($endTime);
                    $diff = $fromTime->diff($toTime);
                    $PlayerData[$seq] = array(
                        'id' => $objPlayerData->sql[$seq]->id,
                        'playerName' => $objPlayerData->sql[$seq]->player_name,
                        'shipNumber' => $objPlayerData->sql[$seq]->ship_number,
                        'diffTime' => $diff->format('%d日%h時間%i分%s秒'),
                        'endFlag' => $endFlag,
                        'fromTime' => $fromTime,
                        'endTime' => $endTime,
                    );
                }
            }
            return view('/timer' , [
                'playerData' => $PlayerData
            ]);
        }
        // ログイン状態でなければログイン画面へリダイレクト
        return redirect() -> route('login');
    }
    /**
     * スーパータイマー　共通
     * @param Request  
     * @param id プレイヤーID
     * @param day 日にち
     * @param hour 時間
     * @param minutes 分
     * @return view
     */
    public function sameTimer(Request $request){

        // スタートボタン押下時
        if(isset($_POST['start_timer'])){
            // 現在時間を取得
            $objFromTime = new Datetime();
            $fromTime = $objFromTime->format('Y-m-d H:i:s');
            // 入力された日にち、時間、分から該当日時を割り出す
            $id = (int)$request['id'];
            $day = (int)$request['day'];
            $hour = (int)$request['hour'];
            $minutes = (int)$request['minutes'];
            $toTime = date('Y-m-d H:i:s', strtotime("+" .$day." days" .$hour." hours" .$minutes." minutes"));

            // 実行
            $this->startTimer($id, $fromTime, $toTime);
        }
        // リセットボタン押下時
        if(isset($_POST['reset_timer'])){
            $id = $request['id'];
            // 実行
            $this->resetTimer($id);
        }

        // 削除ボタン押下時
        if(isset($_POST['delete_player'])){
            $id = $request['id'];
            // 実行
            $this->deletePlayer($id);
        }

        // 一覧にリダイレクト
        return redirect()->route('timerIndex');
    }
    /**
     * スーパータイマー　登録
     * @param player
     * @return view
     */
    public function registTimer(Request $request){

        $playerName = $request['player_name'];
        $shipNumber = (int)$request['ship_number'];

        // 入力チェック
        $judgement = $this->validationCheck($playerName, $shipNumber);
        if($judgement == true){
            // DB登録
            $this->player->setPlayer($playerName, $shipNumber);
        }

        return redirect()->route('index');
    }
    /**
     * スーパータイマー　入力チェック
     * @param player
     * @return view
     */
    public function validationCheck($playerName, $shipNumber){
        if(!isset($playerName)){

        }
        if(!isset($shipNumber) || !is_int($shipNumber)){
            
        }

        return true;
    }

    /**
     * スーパータイマー　スタート
     * @param id プレイヤーID
     * @param id 現在日時
     * @param id 終了日時
     * @return sameTimer
     */
    public function startTimer($id, $fromTime, $toTime){
        // DB登録
        $this->timer->setTimer($id, $fromTime, $toTime);

        // 共通に戻る
        return;
    }

    /**
     * スーパータイマー　リセット
     * @param id プレイヤーID
     * @return view
     */
    public function resetTimer($playerId){
        // タイマー削除
        $this->timer->deleteTimer($playerId);

        // 共通に戻る
        return;
    }

    /**
     * スーパータイマー　削除
     * @param id プレイヤーID
     * @return view
     */
    public function deletePlayer($id){
        // 削除
        $this->player->deletePlayer($id);
        $this->timer->deleteTimer($id);

        // 共通に戻る
        return;
    }

    /**
     * スーパータイマー　メンバー登録処理
     * @param inputs 入力内容
     * @param rules バリデーションルール
     * @return view
     */
    public function create(){
        return view('regist.register');
    }

    public function store(UserRegistPost $request){

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'age'      => $request->age,
            'password' => Hash::make($request->password), 
        ]);
        
        // 完了画面に遷移
        return view('regist.complete', compact('user'));
    }

}
