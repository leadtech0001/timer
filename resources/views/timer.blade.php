
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>SuperTimer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body class="mt-4">
        <div class="container">
            <p><a href="{{ route('logout')}}">ログアウトする</p>
            <h1><a href="timer">SuperTimer</a></h1>
            
            <h2>タイマー登録</h2>
            <form action= "{{ route('resist')}}" method="POST" class="form-inline mb-2">
                @csrf
                <div class="form-group mr-2">
                    <input type="text" name="player_name" class="form-control" placeholder="プレイヤー名を入力" required>
                    <select name="ship_number" class="form-control" required>
                        <option value=1>1隻目</option>
                        <option value=2>2隻目</option>
                        <option value=3>3隻目</option>
                        <option value=4>4隻目</option>
                    </select>
                </div>
                <button type="submit" name="submit_add_player" class="btn btn-primary">登録</button>
            </form>
                <h2>タイマー 一覧</h2>
                <input type="text" id="search"> <input type="button" value="絞り込む" id="button"> <input type="button" value="すべて表示" id="button2">     
                <table id="table" class="table table-info table-striped table-bordered">
                <thead>
                    <tr>
                    <th id="0" data-sort="">プレイヤー情報</th>
                    <th id="1" data-sort="">時間設定</th>
                    <th id="2" data-sort="">各種ボタン</th>
                    <th id="3" data-sort="">残り時間</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($playerData[0])): ?>
                    <?php foreach($playerData as $player): ?>
                        <tr>
                        <form action="{{ route('same')}}"  method="POST" class="form-inline mb-2" style="display:inline;">
                        @csrf
                            <td><?=$player['playerName'].$player['shipNumber'].'隻目'; ?></td>
                            <td>
                                <input type="hidden" name="id" class="form-controla" value="<?=$player['id'] ?>">
                                <input type="number" name="day" class="form-controla" min="0" style="width:80px;">日
                                <input type="number" name="hour" class="form-controla" min="0" max="23" style="width:80px;">時間
                                <input type="number" name="minutes" class="form-controla" min="0" max="59" style="width:80px;">分
                            
                            </td>
                            <td>
                                <?php if($player['diffTime'] == "0日0時間0分0秒"): ?>
                                    <button type="submit" name="start_timer" class="btn btn-primary">スタート</button>
                                <?php endif ?>
                                <button type="submit" name="reset_timer" class="btn btn-primary">リセット</button>
                                <button type="submit" name="delete_player" class="btn btn-primary">削除</button>
                            </td>
                            <td id="timeDisplay{{$player['id']}}">
                            </td>
                        </form>
                        </tr>
                        
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
                </table>
        </div>
        
        <!-- BootstrapなどのJavaScript（ここでは省略） -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>

        <script>

        const initialDate = @json($playerData);
        console.log(initialDate);
        
        function timer(){
            $('#timeDisplay').html('');
            for (let i of initialDate) {
                console.log(i['endTime']);
                var m = moment(i['endTime'], "YYYY-MM-DD HH:mm:ss");


                var duration = moment.duration(m.diff(moment(), "seconds"), "seconds");
                var countTime = m.diff(moment(), "seconds");
                let day = Math.floor(duration.asDays());
                let time = day + '日' + duration.hours()+ '時間' + duration.minutes() + '分' + duration.seconds() + '秒';
                console.log("time", time);
                
                if(i['endFlag'] == 1 && countTime <= 0){
                    $('#timeDisplay'+ i['id']).html('完了')
                }else if(i['endFlag'] == 1 && countTime > 0){
                    $('#timeDisplay'+ i['id']).html(time)
                }
            }
        }
        setInterval(timer, 1.0*1000);

        function abc(){
            // 情報取得
            let ele = $(this).attr('id');
            let sortFlg = $(this).data('sort');

            // リセット
            $('th').data('sort', "");

            // ソート順序
            if(sortFlg == "" || sortFlg == "desc"){
                sortFlg = "asc";
                $(this).data('sort', "asc");
            }else{
                sortFlg = "desc";
                $(this).data('sort', "desc");
            }

            // テーブルソート処理
            sortTable(ele, sortFlg);
        };

        /**
         * クリックイベント
         */
        $(document).on("click","th", abc);

        /**
         * テーブルソートメソッド
         * 
         * @param ele 
         * @param sortFlg 
         */
        function sortTable(ele, sortFlg){
            const tbody = document.getElementById('table').getElementsByTagName('tbody')[0],
                items = tbody.getElementsByTagName('tr');
            for(let i = 0; i < items.length; i++){
                const aNum = items[i].getElementsByTagName('td')[ele].textContent;
                for(let j = 0; j < items.length; j++){
                    if(i >= j) continue;
                    const bNum = items[j].getElementsByTagName('td')[ele].textContent;
                    if(sortFlg == 'asc'){
                        if(aNum > bNum){
                            tbody.insertBefore(items[j], items[i]);
                        }
                    }else if(aNum < bNum){
                        tbody.insertBefore(items[j], items[i]);
                    }
                }
            }
        }
  

        $(function(){
	$('#button').bind("click",function(){
		var re = new RegExp($('#search').val());
		$('#table tbody tr').each(function(){
			var txt = $(this).find("td:eq(0)").html();
			if(txt.match(re) != null){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
	});

	$('#button2').bind("click",function(){
		$('#search').val('');
		$('#table tr').show();
	});
});
        </script>
    </body>
</html>