
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
 *  -- エラーチェック （プレーヤエントリ時）--
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


/**
 * -- エラーチェック （しりとり入力時）--
 */


function word1() {

    const regex1 = /^[\u3041-\u3096ー]+$/;
    var fighter_word1 = document.getElementById('fighter_word1').value;
    var last_letter = fighter_word1.slice(-1);

    if (word_form1.fighter_word.value == "") {
        document.getElementById("err_word1").innerText = "【エラー】：文字を入力してください";
        return false;
    } else if (last_letter == "ん") {
        document.getElementById("err_word1").innerText = "【エラー】：「ん」で終わっています。やり直してください";
        return false;
    } else if (regex1.test(fighter_word1) == false) {
        document.getElementById("err_word1").innerText = "【エラー】：ひらがなで入力してください";
        return false;
    } else {
        return true;
    }
}


function word2() {
    const regex2 = /^[\u3041-\u3096ー]+$/;

    var fighter_word2 = document.getElementById('fighter_word2').value;
    var one_letter = fighter_word2.slice(0, 1);
    var last_letter = fighter_word2.slice(-1);
    var last_word = document.getElementById("last_word").value;

 
    if (word_form2.fighter_word.value == "") {
        document.getElementById("err_word2").innerText = "【エラー】：文字を入力してください";
        return false;
    } else if (last_letter == "ん") {
        document.getElementById("err_word2").innerText = "【エラー】：「ん」で終わっています。やり直してください";
        return false;
    } else if (one_letter != last_word) {
        document.getElementById("err_word2").innerText = "【エラー】：最後の文字とつながっていません。";
        return false;
    } else if (regex2.test(fighter_word2) == false) {
        document.getElementById("err_word2").innerText = "【エラー】：ひらがなで入力してください";
        return false;
    } else {
        return true;
    }
}

// function word() {
//     const regex2 = /^[\u3041-\u3096ー]+$/;

//     var check_word = document.getElementById('fighter_word').value;
//     var one_letter = check_word.slice(0, 1);
//     var last_letter = check_word.slice(-1);
//     var last_word = document.getElementById("last_word").value;

 
//     if (word_form2.fighter_word.value == "") {
//         document.getElementById("err_word").innerText = "【エラー】：文字を入力してください";
//         return false;
//     } else if (last_letter == "ん") {
//         document.getElementById("err_word").innerText = "【エラー】：「ん」で終わっています。やり直してください";
//         return false;
//     } else if (one_letter != last_word) {
//         document.getElementById("err_word").innerText = "【エラー】：最後の文字とつながっていません。";
//         return false;
//     } else if (regex2.test(check_word) == false) {
//         document.getElementById("err_word").innerText = "【エラー】：ひらがなで入力してください";
//         return false;
//     } else {
//         return true;
//     }
// }
