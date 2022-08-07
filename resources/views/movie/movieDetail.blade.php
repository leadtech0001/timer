
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

            <p>{{ $movieDetail['watchFlag'] }}</p>
            <table>
                <tr>
                    <th>ID</th>
                    <td>{{ $movieDetail['id'] }}</td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td>{{ $movieDetail['movieName'] }}</td>
                </tr>
                <tr>
                    <th>メイン画像</th>
                    <td>{{ $movieDetail['imagePath'] }}</td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td>{{ $movieDetail['genre'] }}</td>
                </tr>
                <tr>
                    <th>自己評価</th>
                    <td>{{ $movieDetail['evaluation'] }}</td>
                </tr>
                <tr>
                    <th>世間の評価</th>
                    <td>{{ $movieDetail['publicEvaluation'] }}</td>
                </tr>
            </table>
            <div>
                <a href="{{ route('movie-evaluation', ['id' => $movieDetail['id']] ) }}">評価を入力</a>
            </div>
        </div>
    </body>
</html>