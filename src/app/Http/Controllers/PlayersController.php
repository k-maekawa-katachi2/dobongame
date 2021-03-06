<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PlayersController extends Controller
{
    /**
     * playersのページを表示する
     * （この時に今まで登録した履歴を全て消去する）
     */

    public function index()
    {
        $user_id = Auth::user()->id;

        // ログインユーザの履歴を削除する
        DB::table('players')->where('user_id', $user_id)->delete();
        DB::table('demon_words')->where('user_id', $user_id)->delete();
        DB::table('fighter_words')->where('user_id', $user_id)->delete();

        session()->forget('chara_id');
        return view('games.players');
    }


    /**
     *  プレーヤの設定・登録
     */
    public function enter(Request $request)
    {

        // バリデーション
        $validatedData = $request->validate([
            'chara' => 'required',
            'player' => 'required'
        ], [
                    'chara.required' => '【エラー】：チェックしてください',
                    'player.required' => '【エラー】：枠内を入力してください',
        ]);
     
        /**if = computer設定
         * else = デーモンがプレーヤ設定
         */
        if ($request->chara == 0) {
            $param = [
                'chara' =>  $request->chara,
                'player' => 'computer',
                'user_id' => Auth::user()->id,
                'player_number' => $request->player_number
            ];

            session()->put('chara_id', '0');
        } else {
            $param = [
                'chara' =>  $request->chara,
                'player' => $request->player,
                'user_id' => Auth::user()->id,
                'player_number' => $request->player_number
            ];
        }

        //  同じ名前が存在するかチェックする　・・　存在する＝戻る条件になる
        $play_number_check = DB::table('players')->where('player', $request->player)->exists();

        if ($play_number_check == true) {
            DB::table('players')->where('player', $request->player)->where('user_id', '=', Auth::user()->id)->update($param);
        } else {
            DB::table('players')->insert($param);
        }

        //    デーモンの種類の決定とデーモンのデータおよびターン数をセッションで保存
        $chara_id = session()->get('chara_id');
        if ($chara_id == '0') {
            $demon_name = 'computer';
        } else {
            $demon_name = DB::table('players')->where('user_id', '=', Auth::user()->id)->where('chara', '=', '1')->first('player');
        }

        // demon_nameを保存
        session()->put('demon_name', $demon_name);
        // ターンを保存（この式がないと、ファイター選択時に$turnがnullになってしまう
        if ($request->turn != null) {
            session()->put('turn', $request->turn);
        };

        $players = DB::table('players')->where('user_id', '=', Auth::user()->id)->orderBy('player_number', 'asc')->get();
        $number = DB::table('players')->where('user_id', '=', Auth::user()->id)->orderBy('player_number', 'desc')->first('player_number');
        $next = $number->player_number + 1;

        return view('games.fighter_entry', [
            'players' => $players,
            'next' => $next,
            'chara_id' => $chara_id
        ]);
    }
}
