<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ユーザー登録フォーム</title>
    </head>
    <body>
        <h1>メンバー登録フォーム</h1>
        <ul style="color: #ff0000;">
        @if(count($errors) > 0)
            @foreach($errors -> all() as $errors)
                <li> {{$errors}} </li>
            @endforeach
        @endif
        </ul>
        <form name="registform" action="{{ route('register')}}" method="post" id="registform">
            {{csrf_field()}}
            <dl>
                <dt>名前:</dt>
                <dd>
                    <input type="text" name="name" size="30">
                </dd>
            </dl>
            <dl>
                <dt>メールアドレス:</dt>
                <dd>
                    <input type="text" name="email" size="30">
                </dd>
            </dl>
            <dl>
                <dt>年齢:</dt>
                <dd>
                    <input type="text" name="age" size="30">
                </dd>
            </dl>
            <dl>
                <dt>パスワード:</dt>
                <dd>
                    <input type="password" name="password" size="30">
                </dd>
            </dl>
            <dl>
                <dt>パスワード（確認）:</dt>
                <dd>
                    <input type="password" name="password_confirmation" size="30">
                </dd>
            </dl>
            <button type="submit" name="action" value="send">送信する</button>
        </form>
    </body>
</html>