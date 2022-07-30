<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログインフォーム</title>
    </head>
    <body>
        <h1>会員ログイン</h1>
        @if (session('flash_message'))
            <div class="flash_message" style="color: green;" >
                {{ session('flash_message') }}
            </div>
        @endif
        @isset($errors)
            <p style="color:red">{{ $errors->first('message') }}</p>
        @endisset
        <form name="loginform" action="{{ route('movie-login')}}" method="post">
            {{csrf_field()}}
            <dl>
                <dt>メールアドレス</dt><dd><input type="text" name="email" size="30" value="{{old('email')}}"></dd>
                <dt>パスワード</dt><dd><input type="password" name="password" size="30"></dd>
            </dl>
            <button type="submit" name="action" value="send">ログイン</button>
        </form>
        <a href="{{ route('movie-register')}}">登録がまだお済みでない方はこちらから</a>
    </body>
</html>