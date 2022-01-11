<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FighterController extends Controller
{
    //

    public function index(Request $request)
    {    
        // エラーの作成中
        //  $session_last_word = session()->get('last_word');
        // // dd( $session_last_word);
       
        //  // エラーチェック
        // if(isset($session_last_word)){
        //     $first_word = mb_substr($request->fighter_word,0,1);
        //     if($first_word !== $session_last_word){
        //         $msg = '言葉がしりとりとしてつながっていません。文字を入力しなおしてください';
        //        return back()->withinput();
        //     }
        // }
          


        // ドボンかセーフか判定する。
        // ⓵　セッションでデーモンの言葉を呼び出す
        $kana1 = session()->get('demon_kana1');
        $kana2 = session()->get('demon_kana2');
        $kana3 = session()->get('demon_kana3');


        // ⓶　ファイターの言葉の最後の文字を取得する
        $last_word = mb_substr($request->fighter_word, -1);
        session()->put('last_word',$last_word);

        // ⓷　デーモンの言葉と一致＝ドボン、　一致しない＝セーフ
        if ($last_word == $kana1->hiragana || $last_word == $kana2->hiragana || $last_word == $kana3->hiragana) {
            $judge = 'doboon';
        } else {
            $judge = 'safe';
        }


        // 記録を入力する
        $param = [
            "turn" =>  $request->turn,
            "fighter_word" => $request->fighter_word,
            "player_id"  => $request->player_id,
            "order_count" => $request->order_count,
            "user_id" => Auth::user()->id,
            "judge" => $judge
        ];

        DB::table('fighter_words')->insert($param);

        // 次のファイターを情報を取り出す
        $next_fighter = DB::table('players')->where('player_number', '>', $request->order_count)->first();


        // ファイターが最後の場合、次のページ(resultWaiting.blade.php)に移動する
        if (empty($next_fighter)) {
            $fighter_word_all = DB::table('fighter_words')
                ->join('players', 'fighter_words.player_id', '=', 'players.id')
                ->select('fighter_words.*', 'players.player')
                ->where('fighter_words.user_id', '=', Auth::user()->id)->get();

            return view('games.resultWaitng', ['fighter_word_all' => $fighter_word_all]);
        }


        $before_word = DB::table('fighter_words')->where('order_count', '=', $request->order_count)->orderBy('id', 'desc')->limit(1)->get('fighter_word');
        //　↑　完成時にはorderBy('id','desc')をorderBy('order_count','desc')に変更すること、今は作成のためこのまま

      
        $fighter_word_all = DB::table('fighter_words')->where('user_id', '=', Auth::user()->id)->get('fighter_word');
        $turn = session()->get('turn');

        // プレーヤカウントが４または８の場合、一度デーモンの攻撃動画に移る
        if ($request->order_count == '4' || $request->order_count == '8') {
            session(['next_fighter' => $next_fighter]);
            session(['before_word' => $before_word[0]]);
            session(['fighter_word_all' => $fighter_word_all]);
            session(['turn' => $turn]);

            return view('games.demonAttack',[
                'order_count' =>$request->order_count
            ]
        );
        } else {
            return view('games.game', [
                'next_fighter' => $next_fighter,
                'before_word' => $before_word[0],
                'fighter_word_all' => $fighter_word_all,
                'turn' => $turn
            ]);
        }
    }

    public function afterMovie(){
        $next_fighter = session()->get('next_fighter');
        $before_word = session()->get('before_word');
        $fighter_word_all = session()->get('fighter_word_all');
        $turn = session()->get('turn');

        return view('games.game', [
            'next_fighter' => $next_fighter,
            'before_word' => $before_word,
            'fighter_word_all' => $fighter_word_all,
            'turn' => $turn
        ]);



    }
}
