<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FighterWord implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value  fither_wordの入力
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /*****チェック項目*****/
        //   ひらがなで入力されているか確認。　true=0 false=1 
        $word_check = preg_match('/[^ぁ-んー]/u', $value);
        //  最初の単語と最後の単語を出力する
        $first_letter =  mb_substr($value, 0, 1);
        $last_letter = mb_substr($value, -1);

        // next_fighterの時の処理
        if (session('last_word') != null) {
            $last_word = session()->get('last_word');
            if ($last_word !=   $first_letter) {
                return false;
            } else {
                return true;
            }
        }

        // first_fighter,next_fighter共通
        if ($last_letter == "ん") {
            return false;
        } elseif ($word_check == 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "しりとりがなりたっていません。入力をやり直してください。";
    }
}
