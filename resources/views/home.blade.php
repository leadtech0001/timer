<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>トップ画面</title>
    </head>
    <body>
        <p>オッス！　おら悟空！
        @if(Auth::check())
            {{\Auth::user()->name}}さん</p>
            <p><a href="{{ route('timerIndex')}}">タイマー編集に進む</a></p>
            <p><a href="/timer/public/logout">ログアウト</a>
        @else
            ゲストさん</p>
            <p><a href="/timer/public/login">ログイン</a><br><a href="/timer/public/register">会員登録</a></p>
        @endif
    </body>
</html>