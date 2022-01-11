
/**
 * 　デーモンの選択。プレーヤの選択時に名前の入力する枠が出現される
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
 *  -- エラーチェック --
 *  ⓵　if     :ラジオボタンにチェックがない場合のエラー
 *  ⓶　else if:名前の入力欄が未記入の場合にエラー
 *  ⓷　else   :問題なし、trueで動作を実行する
 */
function check() {
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