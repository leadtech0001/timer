
<!DOCTYPE html>
<html lang="ja">

<?php  $test = app()->make(MovieViewHealper::class);   ?>
<?php App\Resources\views\movie\MovieViewHealper::test(); ?>

{{--@inject('$MovieViewHealper', 'resources\views\helper\movie\MovieViewHealper')--}}
    <head>
        <meta charset="utf-8">
        @push('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/movie/movieCss.css') }}">
        @endpush
        <title>一覧</title>
    </head>
    <body class="mt-4">
        <div class="container">
            <p><a href="{{ route('movie-logout')}}">ログアウトする</a></p>
            <h1>見たい映画一覧画面</h1>
            
            <h2>検索</h2>
            <form action= "{{ route('movie-search')}}" method="POST" class="form-inline mb-2">
                @csrf
                <div class="form-group mr-2">
                    <input type="text" name="movie_name" class="form-control" placeholder="映画名">
                    @foreach($genreList as $genreTitle)
                    <div>
                        <input type="radio" name="genre" value="{{ $genreTitle }}">
                        <label>{{ $genreTitle }}</label>
                        
                    </div>
                    @endforeach
                </div>
                <button type="submit" name="search" class="btn btn-primary">検索する</button>
            </form>
            <div>
                @if($movieList->movieList->isNotempty())
                    <table>
                        <tr>
                            <th>タイトル</th>
                            <th>ジャンル</th>
                            <th>推移</th>
                            <th>自己評価点数</th>
                            <th>世間評価点数</th>
                            <th>見たフラグ</th>
                            <th></th>
                            <th></th>
                            @foreach($movieList->movieList as $value)
                                <tr>
                                    <th>{{$value->movie_name}}</th>
                                    <th>{{$value->genre}}</th>
                                    <th></th>
                                    <th>{{$value->evaluation}}</th>
                                    <th>{{$value->public_evaluation}}</th>
                                    <th>{{$value->watch_flag}}</th>  
                                    <th><a href="{{ route('movie-evaluation', ['id'=>$value->id] ) }}">評価を入力</a></th>
                                    <th><a href="{{ route('movie-detail', ['id'=>$value->id] ) }}">詳細</a></th>
                                </tr>
                            @endforeach                                              
                        </tr>
                    </table>
                @else
                    <p style="color:red ;">1件もヒットしませんでした。</p>
                @endif
        </div>
    </body>
</html>