
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>詳細</title>
    </head>
    <body class="mt-4">
        <div class="container">
            <p><a href="{{ route('movie-index')}}">一覧に戻る</a></p>
            <h1>見たい映画詳細画面</h1>

            <p>{{ $watchFlag }}</p>
            
            <table id="table">
                <thead>
                    <tr>
                        <th id="0" data-sort="">タイトル</th>
                        <th id="1" data-sort="">メイン画像</th>
                        <th id="1" data-sort="">ジャンル</th>
                        <th id="2" data-sort="">自己評価</th>
                        <th id="3" data-sort="">世間の評価</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $id }}</td>
                        <td>{{ $movieName }}</td>
                        <td>{{ $genre }}</td>
                        <td>{{ $evaluation }}</td>
                        <td>{{ $publicEvaluation }}</td>
                        <td>{{ $imagePath }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>