<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     *  最終結果のまとめる・・doboonを発生した人がいたらgame_overとする
     */
    public function index(Request $request)
    {

        // $fighter_word_all : ファイターが入力した情報の一覧を呼び出す
        $fighter_word_all = DB::table('fighter_words')
            ->join('players', 'fighter_words.player_id', '=', 'players.id')
            ->select('fighter_words.*', 'players.player')
            ->where('fighter_words.user_id', '=', Auth::user()->id)->get();

        // $doboon_check: doboonが存在するかチェックする
        $doboon_check = DB::table('fighter_words')->where('judge', 'doboon')->exists();
        if ($doboon_check == true) {
            $doboon = 'game_over';
        } else {
            $doboon = 'clear';
        }

        // $kana1,$kana2,$kana3 : demon_kanaのセッション情報
        $kana1 = session()->get('demon_kana1');
        $kana2 = session()->get('demon_kana2');
        $kana3 = session()->get('demon_kana3');

        // $demon_kana_all : demon_kanaを配列にまとめる
        $demon_kana_all = [$kana1, $kana2, $kana3];
        return view('games.result', [
            'doboon' => $doboon,
            'demon_kana_all' => $demon_kana_all,
            'fighter_word_all' => $fighter_word_all
        ]);
    }
}
