<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemmonController extends Controller
{
    /**
     * デーモンの言葉を設定する　
     */
    public function index()
    {
        // デーモンの名前を呼び出す
        $demon_name = session()->get('demon_name');

        /**
         * コンピュータの設定時の入力
         *     ●　if・・・コンピュータ設定
         *     ●　else・・プレーヤ設定（index -> enter）
         */
        if ($demon_name == "computer") {
            $array = range(11, 72);
            //配列をシャッフルする
            shuffle($array);
            //配列の上から3番目まで切り取る
            $array = array_slice($array, 0, 3);
            $this->rule($array[0], $array[1], $array[2]);
            return redirect('start');
        } else {
            // ひらがな一覧表を呼び出す
            $kana_alls = DB::table('kana_alls')->get();
            session()->put('kana_alls', $kana_alls);

            return view(
                'games.demmon_words',
                [
                    'kana_alls' =>  $kana_alls,
                    'demon_name' => $demon_name
                ]
            );
        }
    }

    /**
     * デーモンがプレーヤ設定、入力した番号で言葉を作成する
     */
    public function enter(Request $request)
    {
        // $err_msg1,$err_msg2,$err_msg3 : 入力漏れがあった場合”エラーです”を表示
        $err_msg1 = $this->testCheck($request->demon_word1);
        $err_msg2 = $this->testCheck($request->demon_word2);
        $err_msg3 = $this->testCheck($request->demon_word3);

        if (isset($err_msg1) || isset($err_msg2) || isset($err_msg3)) {
            return view(
                'games.demmon_words',
                [
                    'msg' => 'デーモンの言葉は11から89の間で半角で入れてください',
                    'demon_name' => session()->get('demon_name'),
                    'kana_alls' => session()->get('kana_alls')
                ]
            );
        } else {
            $this->rule($request->demon_word1, $request->demon_word2, $request->demon_word3);
            return redirect('start');
        };
    }

    /**
     * 　ゲームスタートの画面に移動する
     */
    public function gameStart()
    {
        // ターンとファーストプレーヤの情報をsessionから呼び出す
        $turn_count = '1';
        $first_player = session()->get('first_player');
        return view(
            'games.game',
            [
                'turn_count' => $turn_count,
                'first_player' => $first_player
            ]
        );
    }

    /**
     * デーモンの入力した番号からひらがなを１文字抽出する
     * 
     * @param string $colum_name: カラム名
     * @param int    $demon_word: 入力した番号
     * @ string $demon_kana: 入力した番号のひらがな
     */
    private function oneKana($colum_name, $demon_word)
    {
        $demon_kana = DB::table('demon_words')->join('kana_alls', $colum_name, '=', 'kana_alls.word_id')
            ->select('kana_alls.hiragana')
            ->where($colum_name, '=', $demon_word)
            ->where('demon_words.user_id', '=', Auth::user()->id)
            ->orderBy('demon_words.id', 'desc')
            ->first();

        return $demon_kana;
    }

    /**
     * 　デーモンワードに入力した文字をひらがなに変換して登録する
     * 
     *  @param int $demon_word1: デーモンワード1に入力する数字 
     *  @param int $demon_word2: デーモンワード2に入力する数字 
     *  @param int $demon_word3: デーモンワード3に入力する数字  
     */
    private function rule(int $demon_word1, int $demon_word2, int $demon_word3)
    {
        // デーモンの言葉をデータベースに入力する
        $param = [
            'demon_word1' => $demon_word1,
            'demon_word2' => $demon_word2,
            'demon_word3' => $demon_word3,
            'user_id' =>  Auth::user()->id
        ];

        // demon_wordsのデータベースに登録する
        DB::table('demon_words')->insert($param);

        // demon_wordsに登録した番号をひらがなに変換する
        $demon_kana1 = $this->oneKana('demon_words.demon_word1', $demon_word1);
        $demon_kana2 = $this->oneKana('demon_words.demon_word2', $demon_word2);
        $demon_kana3 = $this->oneKana('demon_words.demon_word3', $demon_word3);

        // ゲーム開始にあたり、最初のファイターを呼び出す
        $first_player = DB::table('players')->where('chara', '=', '2')->first();

        // セッションに保存
        session(['demon_kana1' => $demon_kana1]);
        session(['demon_kana2' => $demon_kana2]);
        session(['demon_kana3' => $demon_kana3]);
        session(['first_player' => $first_player]);
    }

    /**
     *  デーモンワードの番号が正しいかチェック
     *    
     *  @return string $err_msg : 一つでも抜けていたら"エラー"を返す　 
     */
    private function testCheck($return_all)
    {
        if ($return_all < '11' || $return_all > '89' || $return_all == null) {
            $err_msg = "エラー";
            return $err_msg;
        }
    }
}
