<?php

namespace App\Models\movie;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MovieUser extends User
{

    /**
     * 会員情報登録
     * @param userInformation 会員情報
     */
    public function setMovieUser($userInformation)
    {
        DB::table('movie_users') -> insert([
                'user_name'  => $userInformation['name'],
                'age'        => $userInformation['age'],
                'sex'        => $userInformation['sex'],
                'email'      => $userInformation['email'],
                'password'   => Hash::make($userInformation['password']),
                'created_at' => $userInformation['created_at'],
                ]);
        return;
    }

    /**
     * 会員情報削除
     * @param id 会員ID
     * 
     */
    public function deleteMovieUser($id)
    {
        DB::table('movie_users') -> where('id', '=', $id) -> delete();

        return;
    }
}
