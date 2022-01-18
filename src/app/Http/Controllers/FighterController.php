<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FighterController extends Controller
{
    /**
     *  ファイターが入力した文字をジャッジする
     * 
     *  @param string $kana1,$kana2,$kana3 : demon_kanaのセッション情報
     *  @param string $check_word : ファイターの入力した最後の文字（または２つ前の文字）
     *  @param bool $judge : デーモンの言葉と一致したらfalse('doboon')、一致しなかったらtrue('safe')
     *  @param string $last_word : ファイターの最後の単語　＝　次のファイターがしりとりに使う最初の言葉
     *  @param array $param : テーブル('fighter_words)に登録するデータ
     *  @param array $next_fighter : 次のファイターの情報
     *  @param int $order_count : 次のファイターで表示するカウント
     *  @param int $turn : 最初に設定したターンの回数
     *  @param int $turn_count : 現在のターンの回数
     *  @param array $fighter_word_all : ファイターが入力した情報の一覧
     *  @param string $before_word : ひとつ前のファイターが入力した言葉
     * 
     */

    public function index(Request $request)
    {

        /**
         * ドボンかセーフか判定する。
         */
        // ⓵　セッションでデーモンの言葉を呼び出す
        $kana1 = session()->get('demon_kana1');
        $kana2 = session()->get('demon_kana2');
        $kana3 = session()->get('demon_kana3');


        // ⓶　ファイターの言葉の最後の文字を取得する
        $check_word = mb_substr($request->fighter_word, -1);
        // 単語の語尾が伸ばす文字「ー」で終わったいるときは「ー」のひとつ前の文字を使う
        if ($check_word == "ー") {
            $check_word = mb_substr($request->fighter_word, -2, 1);
        }


        // ⓷　デーモンの言葉と一致＝ドボン、　一致しない＝セーフ
        if ($check_word == $kana1->hiragana || $check_word == $kana2->hiragana || $check_word == $kana3->hiragana) {
            $judge = 'doboon';
        } else {
            $judge = 'safe';
        }

        /**　
         * 　最後の文字をデータで保存する。ただし、小文字の場合は大文字に変換する
         * 　　●　if,elseif : 正規表現にて文字変換および処置
         *   　●　else      : 小文字に該当しない文字の処置
         */

        // 正規表現
        if ($check_word == "ぁ") {
            $last_word = str_replace("ぁ", "あ", $check_word);
        } elseif ($check_word == "ぃ") {
            $last_word = str_replace("ぃ", "い", $check_word);
        } elseif ($check_word == "ぅ") {
            $last_word = str_replace("ぅ", "う", $check_word);
        } elseif ($check_word == "ぇ") {
            $last_word = str_replace("ぇ", "え", $check_word);
        } elseif ($check_word == "ぉ") {
            $last_word = str_replace("ぉ", "お", $check_word);
        } elseif ($check_word == "ゃ") {
            $last_word = str_replace("ゃ", "や", $check_word);
        } elseif ($check_word == "ゅ") {
            $last_word = str_replace("ゅ", "ゆ", $check_word);
        } elseif ($check_word == "ょ") {
            $last_word = str_replace("ょ", "よ", $check_word);
        } elseif ($check_word == "っ") {
            $last_word = str_replace("っ", "つ", $check_word);
        } else {
            $last_word = $check_word;
        }

        //セッションに保存する    
        session()->put('last_word', $last_word);

        // 記録を入力する
        $param = [
            "turn" =>  $request->turn_count,
            "fighter_word" => $request->fighter_word,
            "player_id"  => $request->player_id,
            "order_count" => $request->order_count,
            "user_id" => Auth::user()->id,
            "judge" => $judge
        ];

        DB::table('fighter_words')->insert($param);

        // 次のファイターを情報を取り出す
        $next_fighter = DB::table('players')->where('player_number', '>', $request->player_number)->first();
        $order_count = $request->order_count + 1;

        // 設定したターンの数を呼び出す
        $turn = session()->get('turn');
        $turn_count = $request->turn_count;

        // ファイターが１周したら次の周に回る
        if ($next_fighter == null && $turn_count < $turn) {
            $next_fighter = DB::table('players')->where('player_number', '=', '1')->first();
            $turn_count += 1;
        }

        // ファイターが最後の場合、次のページ(resultWaiting.blade.php)に移動する
        if ($next_fighter == null && $turn_count == $turn) {
            $fighter_word_all = DB::table('fighter_words')
                ->join('players', 'fighter_words.player_id', '=', 'players.id')
                ->select('fighter_words.*', 'players.player')
                ->where('fighter_words.user_id', '=', Auth::user()->id)->get();

            return view('games.resultWaitng', ['fighter_word_all' => $fighter_word_all]);
        }


        // ひとつ前の単語を抽出する
        $before_word = DB::table('fighter_words')->where('order_count', '=', $request->order_count)->orderBy('order_count', 'desc')->limit(1)->get('fighter_word');
        // 今までに入力したファイターの情報を抽出する
        $fighter_word_all = DB::table('fighter_words')->where('user_id', '=', Auth::user()->id)->get('fighter_word');

        // ムービーの後にも使うため、sessionで保存する
        session(['next_fighter' => $next_fighter]);
        session(['before_word' => $before_word[0]]);
        session(['fighter_word_all' => $fighter_word_all]);
        session(['turn_count' => $turn_count]);
        session(['order_count' => $order_count]);

        // プレーヤカウントが４または８の場合、一度デーモンの攻撃動画に移る
        if ($request->order_count == '4' || $request->order_count == '8') {
            return view('games.demonAttack', [
                'order_count' => $request->order_count
            ]);
        } else {
            return redirect('fighters');
        }
    }


    /**
     * ムービーを見た後の処理（再読み込みの時も仕様）
     * 
     * @param array $next_fighter : 次のファイターの情報
     * @param string $before_word : ひとつ前のファイターが入力した言葉
     * @param array $fighter_word_all : ファイターが入力した情報の一覧
     * @param int $turn_count : 現在のターンの回数
     * @param string $last_word : ファイターの最後の単語　＝　次のファイターがしりとりに使う最初の言葉
     * @param int $order_count : 次のファイターで表示するカウント
     * 
     */
    public function afterMovie()
    {
        $next_fighter = session()->get('next_fighter');
        $before_word = session()->get('before_word');
        $fighter_word_all = session()->get('fighter_word_all');
        $turn_count = session()->get('turn_count');
        $last_word = session()->get('last_word');
        $order_count = session()->get('order_count');

        return view('games.game', [
            'next_fighter' => $next_fighter,
            'before_word' => $before_word,
            'fighter_word_all' => $fighter_word_all,
            'turn_count' => $turn_count,
            'last_word' => $last_word,
            'order_count' => $order_count
        ]);
    }
}
