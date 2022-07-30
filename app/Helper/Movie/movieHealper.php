<?php

namespace App\Helper\Movie;


class MovieHealper
{
    // 会員登録 性別
    const MOVIE_USER_SEX_MAN = '男';
    const MOVIE_USER_SEX_WOMAN = '女';

    // 一覧検索 ジャンル
    const MOVIE_GENRE_FANTASY = 'ファンタジー';
    const MOVIE_GENRE_ACTION = 'アクション';
    const MOVIE_GENRE_LOVE_ROMANCE = 'ラブロマンス';
    const MOVIE_GENRE_HORROR = 'ホラー';
    const MOVIE_GENRE_SF = 'SF';
    const MOVIE_GENRE_SUSPENSE = 'サスペンス';
    const MOVIE_GENRE_COMEDY = 'コメディ';
    const MOVIE_GENRE_MUSICAL = '音楽・ミュージカル';
    const MOVIE_GENRE_HISTORICAL_DRAMA = '歴史・時代劇';

    // 見たフラグ
    const MOVIE_WATCH_ALREADY = '視聴済';
    const MOVIE_WATCH_NOT_YET = '未';

    // 見たフラグ配列
    public static $MOVIE_WATCH_ARRAY = array(
        0 => self::MOVIE_WATCH_ALREADY,
        1 => self::MOVIE_WATCH_NOT_YET,
    );

    // ジャンル配列
    public static $MOVIE_GENRE_FANTASY_ARRAY = array(
        0 => self::MOVIE_GENRE_FANTASY,
        1 => self::MOVIE_GENRE_ACTION,
        2 => self::MOVIE_GENRE_LOVE_ROMANCE,
        3 => self::MOVIE_GENRE_HORROR,
        4 => self::MOVIE_GENRE_SF,
        5 => self::MOVIE_GENRE_SUSPENSE,
        6 => self::MOVIE_GENRE_COMEDY,
        7 => self::MOVIE_GENRE_MUSICAL,
        8 => self::MOVIE_GENRE_HISTORICAL_DRAMA,
    );




}