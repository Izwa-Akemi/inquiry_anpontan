<?php
session_start();

// 二重送信防止用トークンの発行
$token = uniqid('', true);

//トークンをセッション変数にセット
$_SESSION['token'] = $token;

//ファイルの読み込み
require_once 'function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/reset.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@300;400;500&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <main>
        <section class="inquiry-sectoin">
            <h2>お問い合わせフォーム確認画面</h2>
            <div class="inquiry-sectoin-inner">
                <form action="inquiry_mail.php" method="POST">
                    <div class="inquiry-checks">
                        <p>お問合せ内容</p>
                        <ul>
                            <?php $check = count($_POST['checks']); ?>
                            <?php for ($i = 0; $i < $check; $i++) { ?>
                                <li><?php echo $_POST['checks'][$i] ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="inquiry-checks">
                        <p>このサイトを知ったきっかけ</p>
                        <div class="inquiry-checks-normal-txt"><?php echo  $_POST['chance'] ?></div>
                    </div>
                    <div class="inquiry-checks">

                        <ul>
                            <li class="inquiry-checks-text">性別:</li>
                            <li><?php echo $_POST['radios']; ?></li>
                        </ul>
                    </div>
                    <div class="inquiry-texts">
                        <div class="inquiry-text">
                            <label class="inquery-text__item"><span>氏名</span><span class="require">必須</span></label>
                            <div><?php echo $_POST['name']; ?></div>
                        </div>
                        <div class="inquiry-text">
                            <label class="inquery-text__item"><span>メールアドレス</span><span class="require">必須</span></label>
                            <div><?php echo $_POST['email']; ?></div>
                        </div>
                        <div class="inquiry-text">
                            <label class="inquery-text__item"><span>コメント</span><span class="not-require">任意</span></label>
                            <div><?php if ($_POST['comment'] !== "") { ?>
                                    <?php echo nl2br($_POST['comment']); ?>
                                <?php } else { ?>
                                    <?php echo "コメント無し" ?>
                                <?php } ?></div>
                        </div>
                    </div>

                    <?php $check = count($_POST['checks']); ?>
                    <?php for ($i = 0; $i < $check; $i++) { ?>
                        <input type="hidden" name="checks[]" value="<?php echo $_POST['checks'][$i]; ?>">
                    <?php } ?>
                    <input type="hidden" name="chance" value="<?php echo $_POST['chance']; ?>">
                    <input type="hidden" name="radios" value="<?php echo $_POST['radios']; ?>">
                    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                    <?php if ($_POST['comment'] !== "") { ?>
                        <input type="hidden" name="comment" value="<?php echo $_POST['comment']; ?>">
                    <?php } else { ?>
                        <input type="hidden" name="comment" value="">
                    <?php } ?>
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <div class="submit-button-flex">
                        <button type="button" onclick="history.back();">戻る</button>
                        <button>送信</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>