
/**
 *  デーモンをプレーヤ選択をしたときに名前の欄を表示する
 *  @param var check1 : プレーヤのラジオボタンにチェックが入っていること
 *  @param var hidden_chara : 名前入力欄のID
 * 
 */

// 最初は名前の入力枠を見えない形にする
document.getElementById("hidden_chara").style.display = "none";


function myfunc() {
    var check1 = document.getElementById("chara").checked;
    var hidden_chara = document.getElementById("hidden_chara");

    // ラジオボタンにチェックが入ったら名前の入力欄を表示する
    if (check1 == true) {
        hidden_chara.style.display = "block";
    }
    else {
        hidden_chara.style.display = "none";
    }
}


/**
 * -- エラーチェック （プレーヤエントリ時）--  [players.blade.php]
 *  @param var check1 : プレーヤのラジオボタンにチェックが入っていること
 *  @param var hidden_chara : 名前入力欄のID
 *  @param player_form : players.blade.phpのformタグにあるname属性
 *  @param chara : プレーヤ選択でのラジオボタンのidタグ
 *  @param player : ファイターの名前入力のidタグ
 *  @returns {bool}
 */

function check() {
    /**
     *  ⓵　if     :ラジオボタンにチェックがない場合のエラー
     *  ⓶　else if:名前の入力欄が未記入の場合にエラー
     *  ⓷　else   :問題なし、trueで動作を実行する
     */
    if (player_form.chara.value == "") {
        document.getElementById("err_name").innerText = "【エラー】：ラジオボタンにチェックを入れてください";
        return false;    //送信ボタン本来の動作をキャンセルします
    } else if (player_form.player.value == "" && player_form.chara.value !== "0") {
        document.getElementById("err_name").innerText = "【エラー】：名前を入力してください";
        return false;
    }
    else {
        return true;
    }
}


/**
 * -- エラーチェック （しりとり入力時）--   [game.blade.php]
 *  @const regex : ひらがなおよび伸ばし棒（ー）の正規表現
 *  @param word_form : game_blade.phpのfromタグのname属性
 *  @param last_letter : fighter_wordAに入力された文字の最後の文字
 *  @param err_word : game.blade.phpのid="err_word●●"の属性
 *  @param fighter_wordA : game.blade.phpのtextに入力された内容(value)
 *  @returns bool
 * 
 */

function wordError(word_form, err_word, fighter_wordA) {
    const regex = /^[\u3041-\u3096ー]+$/;
    var last_letter = fighter_wordA.slice(-1);

    if (word_form.fighter_word.value == "") {
        document.getElementById(err_word).innerText = "【エラー】：文字を入力してください";
        return false;
    } else if (last_letter == "ん") {
        document.getElementById(err_word).innerText = "【エラー】：「ん」で終わっています。やり直してください";
        return false;
    } else if (regex.test(fighter_wordA) == false) {
        document.getElementById(err_word).innerText = "【エラー】：ひらがなで入力してください";
        return false;
    } else {
        return true;
    }
}

/**
 * 　最初のファイターの入力チェック（ゲーム中）
 *  @param word_form1 : game_blade.phpのfromタグのname属性
 *  @string 'err_word1' : game.blade.phpのid="err_word1"の属性
 *  @param fighter_word1 : game.blade.phpのid="fighter_word1のvalue
 *  @returns bool
 * 
 */

function word1() {
    var fighter_word1 = document.getElementById('fighter_word1').value;
    if (wordError(word_form1, "err_word1", fighter_word1) == false) {
        return false;
    } else {
        return true;
    }
}


/**
 * 　２人目以降のファイターの入力チェック（ゲーム中）
 *  @param word_form2 : game_blade.phpのfromタグのname属性
 *  @string 'err_word2' : game.blade.phpのid="err_word2"の属性
 *  @param fighter_word2 : game.blade.phpのid="fighter_word2のvalue
 *  @param one_letter : fighter_word2の最初の文字
 *  @param last_word : game.blade.phpのid="last_word"のvalue
 *  @returns bool
 * 
 */

function word2() {
    var fighter_word2 = document.getElementById('fighter_word2').value;
    var one_letter = fighter_word2.slice(0, 1);
    var last_word = document.getElementById("last_word").value;

    if (wordError(word_form2, "err_word2", fighter_word2) == false) {
        return false;
    } else if (one_letter != last_word) {
        document.getElementById("err_word2").innerText = "【エラー】：最後の文字とつながっていません。";
        return false;
    } else {
        return true;
    }
}
