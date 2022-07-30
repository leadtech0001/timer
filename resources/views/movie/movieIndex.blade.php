
<!DOCTYPE html>
<html lang="ja">

<!--この部分がプッシュできるかのテスト-->

<!-- @inject('MovieViewHealper', 'resources\view\helper\movie') -->
$MovieViewHealper = {{resources\views\helper\movie\MovieViewHealper}}
    <head>
        <meta charset="utf-8">
        @push('css')
        <link rel="stylesheet" href="{{asset('/css/movie/movieCss.css')}}">
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
                @if(isset($movieList))
                    <table>
                    <form action=""  method="POST" class="form-inline mb-2" style="display:inline;">
                        <tr>
                            <th>タイトル</th>
                            <th>ジャンル</th>
                            <th>推移</th>
                            <th>自己評価点数</th>
                            <th>世間評価点数</th>
                            <th>見たフラグ</th>
                            <th></th>
                            <th></th>
                            @foreach($movieList as $movie)
                                <tr>
                                    <th>{{$movie['movieName']}}</th>
                                    <th>{{$movie['genre']}}</th>
                                    <th>$MovieViewHealper->evaluationTransitionManager()</th>
                                    <th>{{$movie['evaluation']}}</th>
                                    <th>{{$movie['publicEvaluation']}}</th>
                                    <th>{{$movie['watchFlag']}}</th>
                                    <th><button type="submit" name="evaluation">評価を入力</button></th>
                                    <th><button type="submit" name="detail">詳細</button></th>
                                </tr>
                            @endforeach                                              
                        </tr>
                    </form>
                    </table>
                @else
                    <p style="color:red ;">1件もヒットしませんでした。</p>
                @endif
        </div>
    </body>
</html>