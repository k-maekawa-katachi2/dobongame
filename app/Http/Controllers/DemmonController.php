<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemmonController extends Controller
{
    //

    public function index()
    {
        $kana_alls = DB::table('kana_alls')->get();
        session()->put('kana_alls', $kana_alls);

        $demon_name = session()->get('demon_name');
        

        // コンピュータの設定時の入力・・・次回はここから
        if($demon_name == "computer"){






        }

        return view(
            'games.demmon_words',
            [
                'kana_alls' =>  $kana_alls,
                'demon_name' => $demon_name
            ]
        );
    }

    public function enter(Request $request)
    {

        $word1 = $this->testCheck($request->demon_word1);

        if (isset($word1)) {
            return view(
                'games.demmon_words',
                [
                    'msg' => $word1['msg'],
                    'demon_name' => $word1['demon_name'],
                    'kana_alls' => $word1['kana_alls']
                ]
            );
        }

        $word2 = $this->testCheck($request->demon_word2);
        if (isset($word2)) {
            return view(
                'games.demmon_words',
                [
                    'msg' => $word2['msg'],
                    'demon_name' => $word2['demon_name'],
                    'kana_alls' => $word2['kana_alls']
                ]
            );
        }
        $word3 = $this->testCheck($request->demon_word3);
        if (isset($word3)) {
            return view(
                'games.demmon_words',
                [
                    'msg' => $word3['msg'],
                    'demon_name' => $word3['demon_name'],
                    'kana_alls' => $word3['kana_alls']
                ]
            );
        }



        // デーモンの言葉をデータベースに入力する
        $param = [
            'demon_word1' => $request->demon_word1,
            'demon_word2' => $request->demon_word2,
            'demon_word3' => $request->demon_word3,
            'user_id' => Auth::user()->id
        ];
        DB::table('demon_words')->insert($param);


        // デーモンの言葉と照らしあう = 数字をひらがなに変換する
        $demon_kana1 = DB::table('demon_words')->join('kana_alls', 'demon_words.demon_word1', '=', 'kana_alls.word_id')

            ->select('kana_alls.hiragana')
            ->where('demon_words.demon_word1', '=', $request->demon_word1)
            ->where('demon_words.user_id', '=', Auth::user()->id)
            ->orderBy('demon_words.id', 'desc')
            ->first();

        $demon_kana2 = DB::table('demon_words')->join('kana_alls', 'demon_words.demon_word2', '=', 'kana_alls.word_id')

            ->select('kana_alls.hiragana')
            ->where('demon_words.demon_word2', '=', $request->demon_word2)
            ->where('demon_words.user_id', '=', Auth::user()->id)
            ->orderBy('demon_words.id', 'desc')
            ->first();

        $demon_kana3 = DB::table('demon_words')->join('kana_alls', 'demon_words.demon_word3', '=', 'kana_alls.word_id')

            ->select('kana_alls.hiragana')
            ->where('demon_words.demon_word3', '=', $request->demon_word3)
            ->where('demon_words.user_id', '=', Auth::user()->id)
            ->orderBy('demon_words.id', 'desc')
            ->first();


        // ゲーム開始にあたり、最初のファイターを呼び出す
        $first_player = DB::table('players')->where('chara', '=', '2')->first();


        // セッションに保存
        session(['turn' => $request->turn]);
        session(['demon_kana1' => $demon_kana1]);
        session(['demon_kana2' => $demon_kana2]);
        session(['demon_kana3' => $demon_kana3]);
        session(['first_player' => $first_player]);


        return view('games.gameStart');
    }

    public function gameStart()
    {
        // ターンとファーストプレーヤの情報をsessionから呼び出す
        $turn = session()->get('turn');
        $first_player = session()->get('first_player');


        return view(
            'games.game',
            [
                'turn' => $turn,
                'first_player' => $first_player
            ]
        );
    }
    private function testCheck($return_all)
    {
        $return = [];
        if ($return_all < '11' || $return_all > '83' || $return_all == null) {
            $return = array(
                'msg' => 'デーモンの言葉は11から83の間で半角で入れてください',
                'demon_name' => session()->get('demon_name'),
                'kana_alls' => session()->get('kana_alls'),
            );


            return $return;
        }
    }
}
