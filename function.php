<?php

function sanitize($input_value)// 渡されたバトンに$input_valueという名前をつける
{
    $_texts = array();
   
    // サニタイズした結果の値に$_texts と名付ける
    //foreach制御文を使用することで、連想配列に設定したキーと値を出力
    foreach ($input_value as $key => $value) {
        if (is_array($value)) {
            //$valueが配列なら$_textsを$keyがある分サニタイズ関数を通して配列に入れる
            $_texts[$key] = sanitize($value); 
        } else {
            //$valueが配列以外なら$_textsを$keyがある分htmlspecialcharsして配列に入れる
            $_texts[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
        }
    }
    
    // $_aというバトンを外に渡してあげる
    return $_texts;
}
//sanitize()に$_POSTという値をバトンで渡して、返ってきたバトンに$_POSTと名付ける
$_POST = sanitize($_POST);

