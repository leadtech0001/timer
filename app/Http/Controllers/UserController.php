<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\player;
use Illuminate\Support\Facades\DB;
   
class UserController extends Controller
{
    /**
     * larabelの関数であるページャーの確認用　テストコントローラー
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/users', [
            'player' => DB::table('player')->simplePaginate(1)
        ]);
    }
}