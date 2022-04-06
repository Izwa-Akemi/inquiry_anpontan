<?php
session_start();

// POSTされたトークンを取得
$token = isset($_POST["token"]) ? $_POST["token"] : "";
// セッション変数のトークンを取得
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
// セッション変数のトークンを削除
unset($_SESSION["token"]);
// POSTされたトークンとセッション変数のトークンの比較
if ($token != "" && $token == $session_token) {
   //念のためもう一度サニタイズをしておく
	require_once 'function.php';
	
	/*---スプレッドシートにデータを記入するソースコード-------*/
	if (isset($_POST['checks'])) {
		define('POST_URL', 'アプリのURL');
		 //例
		//define('POST_URL', 'https://script.google.com/macros/s/AKfycbyYF10kvVlmf1N9xFOo2fO1qoTKqcP9W4Pi23V20R7DxIO_sddMwGN1WrEO3kyURwQI/exec');
		$post_data = [
			'checks' => $_POST['checks'],
			'chance' => $_POST['chance'],
			'radios' => $_POST['radios'],
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'comment' => $_POST['comment'],
		];

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => POST_URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($post_data),
		]);
		$response = curl_exec($ch);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		curl_close($ch);
	}





	//管理者のメールアドレスを入力してください。
	$admin_mail = 'メールが受信できるアドレスを書いてね！';
    //記入例
    //$admin_mail = 'test_anpontan@test.com';
    
	$header =  null;//ヘッダー
	$auto_reply_subject = null;//入力者側への件名
	$auto_reply_text = null;//入力者側へのメール本文
	$admin_reply_subject = null;//管理者側への件名
	$admin_reply_text = null;//管理者側へのメール本文
	//日本の時間帯で時間を出力したいので、タイムゾーンを設定
	date_default_timezone_set('Asia/Tokyo');

	//日本語の使用宣言
	mb_language("ja");
	mb_internal_encoding("UTF-8");

	//ヘッダー情報を設定
	$header = "MIME-Version: 1.0\n";
	$header .= "From: お問合せフォーム <".$admin_mail.">"."\n";
	$header .= "Reply-to: お問合せフォーム<".$admin_mail.">"."\n";

	//件名を設定
	$auto_reply_subject = $_POST['name']."様"."お問合せありがとうございます。" . "\n";

	//本文を設定

	$auto_reply_text = "送信日時:" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "以下の内容でお問合せを受け付けました。内容をご確認下さい。\n\n";
	$auto_reply_text .= "お問合せ内容\n";
	$check = count($_POST['checks']);
	for ($i = 0; $i < $check; $i++) {
		$auto_reply_text .= "・" . $_POST['checks'][$i] . "\n";
	}
	$auto_reply_text .= "サイトを知ったきっかけ\n";
	$auto_reply_text .= "・" . $_POST['chance']. "\n";
	$auto_reply_text .= "性別\n";
	$auto_reply_text .= "・" . $_POST['radios']. "\n";
	$auto_reply_text .= "氏名:" . $_POST['name'] . "\n";
	$auto_reply_text .= "メールアドレス:" . $_POST['email'] . "\n";
	$auto_reply_text .= "コメント\n";
	if($_POST['comment'] !== ""){
		$auto_reply_text .=$_POST['comment'] . "\n";
	}else{
		$auto_reply_text .= "コメント無し" . "\n";
	}


	//メール送信
	mb_send_mail($_POST['email'], $auto_reply_subject, $auto_reply_text, $header);

	//運営側へ送るメールの件名
	$admin_reply_subject =  $_POST['name'] ."様"."からお問合せいただきました" . "\n";

	$admin_reply_text = "送信日時:" . date("Y-m-d H:i") . "\n";
	$admin_reply_text .= "下記の内容でお問合せがされました。\n\n";
	$admin_reply_text .= "お問合せ内容\n";
	$check = count($_POST['checks']);
	for ($i = 0; $i < $check; $i++) {
		$admin_reply_text .= "・" . $_POST['checks'][$i] . "\n";
	}
	$admin_reply_text .= "サイトを知ったきっかけ\n";
	$admin_reply_text .= "・" . $_POST['chance']. "\n";
	$admin_reply_text .= "性別\n";
	$admin_reply_text .= "・" . $_POST['radios']. "\n";
	$admin_reply_text .= "氏名:" . $_POST['name'] . "\n";
	$admin_reply_text .= "メールアドレス:" . $_POST['email'] . "\n";
	$admin_reply_text .= "コメント\n";
	if($_POST['comment'] !== ""){
		$admin_reply_text .=$_POST['comment'] . "\n";
	}else{
		$admin_reply_text .= "コメント無し" . "\n";
	}

	//運営側へ送るメール
	mb_send_mail($admin_mail, $admin_reply_subject, $admin_reply_text, $header);

    require('mail.html');
} else {
	require('error.html');
}
