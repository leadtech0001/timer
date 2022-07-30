<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>会員登録フォーム</title>
    </head>
    <body>
        <h1>会員登録フォーム</h1>
        <ul style="color: #ff0000;">
        @if(count($errors) > 0)
            @foreach($errors -> all() as $errors)
                <li> {{$errors}} </li>
            @endforeach
        @endif
        </ul>
        <form name="registform" action="{{ route('movie-register')}}" method="post" id="registform">
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
                <dt>生年月日:</dt>
                <dd>
                <select name="year">
                @for($i=1920; $i <= 2020; $i++)
                    <option value="{{$i}}">{{$i}}</option>';
                @endfor
                </select> 年
                <select name="month">
                @for($i=1; $i <= 12; $i++)
                    <option value="{{$i}}">{{$i}}</option>';
                @endfor
                </select> 月
                <select name="day">
                @for($i=1; $i <= 31; $i++)
                    <option value="{{$i}}">{{$i}}</option>';
                @endfor
                </select> 日
                </dd>
            </dl>
            <dl>
                <dt>性別:</dt>
                <dd>
                    <select name="sex">
                        <option value="man">男</option>
                        <option value="woman">女</option>
                    </select>
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