
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>評価更新</title>
    </head>
    <body class="mt-4">
        <div class="container">
            <p><a href="{{ route('movie-index')}}">一覧に戻る</a></p>
            <h1>評価更新画面</h1>
            <div>
            <form action= "{{ route('resist')}}" method="POST" class="form-inline mb-2">
            @csrf
            <dl>
                <dt>自己評価点数:</dt>
                <dd>
                    <p>⇐低 1 ～ 10 高⇛</p>
                    <select name="evaluationPoint">
                    @for($i=1; $i <= 10; $i++)
                        <option value="{{$i}}">{{$i}}</option>';
                    @endfor
                    </select> 点
                </dd>
            </dl>
            <dl>
                <dt>オススメ</dt>
                <dd>
                    <input type='radio' name='recommend' value="yesRecommend">する</option>
                    <input type='radio' name='recommend' value="noRecommend">しない</option>
                </dd>
            </dl>
            <dl>
                <dt>良かった点</dt>
                <dd>
                    <textarea rows="10" cols="60"></textarea>
                </dd>
            </dl>
            <dl>
                <dt>悪かった点</dt>
                <dd>
                    <textarea rows="10" cols="60"></textarea>
                </dd>
            </dl>
            <dl>
                <dt>総評コメント</dt>
                <dd>
                    <textarea rows="30" cols="100">ここに総評コメントを入力</textarea>
                </dd>
            </dl>
            </div>

            <div>
                <a href="{{ route('movie-evaluation') }}">更新</a>
            </div>
        </div>
    </body>
</html>