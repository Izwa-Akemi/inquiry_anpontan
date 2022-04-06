<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/reset.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Document</title>
</head>

<body>
    <main>
        <section class="inquiry-sectoin">
            <h2>お問い合わせフォーム</h2>
            <div class="inquiry-sectoin-inner">
                <div id="validation"></div>
                <form action="inquiry_confirm.php" method="POST">
                    <div class="inquiry-checks">
                        <p>お問合せ内容</p>
                        <p class='is-error-checks'></p>
                        <ul>
                            <!--もし、$_POST['checks[]']が空でない、かつ、$_POST['checks[]']が選択した内容と一致していたらチェックボックスにチェックを入れる-->
                            <li><input type="checkbox" name="checks[]" value="制作会社の紹介" <?php if (!empty($_POST['checks[]']) && $_POST['checks[]'] === "制作会社の紹介") {
                                                                                            echo 'checked';
                                                                                        } ?>> 制作会社の紹介</li>
                            <li><input type="checkbox" name="checks[]" value="相場の情報" <?php if (!empty($_POST['checks[]']) && $_POST['checks[]'] === "相場の情報") {
                                                                                            echo 'checked';
                                                                                        } ?>> 相場の情報</li>
                        </ul>
                    </div>
                    <div class="inquiry-checks">
                        <p>このサイトを知ったきっかけ</p>
                        <p class="is-error-chance"></p>
                        <select name="chance">
                            <!--もし、$_POST['chance']が空でない、かつ、$_POST['chance']が選択した内容と一致していたら選択していた状態する。-->
                            <option value="webサイト" <?php if (!empty($_POST['chance']) && $_POST['chance'] === "webサイト") {
                                                        echo 'selected';
                                                    } ?>>webサイト</option>
                            <option value="口コミ" <?php if (!empty($_POST['chance']) && $_POST['chance'] === "口コミ") {
                                                    echo 'selected';
                                                } ?>>口コミ</option>
                            <option value="その他" <?php if (!empty($_POST['chance']) && $_POST['chance'] === "その他") {
                                                    echo 'selected';
                                                } ?>>その他</option>
                        </select>
                    </div>
                    <div class="inquiry-checks">
                        <p>性別</p>
                      
                        <p class="is-error-radios"></p>
                        <ul>
                            <!--もし、$_POST['radios']が空でない、かつ、$_POST['radios']が選択した内容と一致していたらラジオボタンにチェックを入れる-->
                            <li><input type="radio" name="radios" value="男性" <?php if (!empty($_POST['radios']) && $_POST['radios'] === "男性") {
                                                                                    echo 'checked';
                                                                                } ?>>男性</li>
                            <li><input type="radio" name="radios" value="女性" <?php if (!empty($_POST['radios']) && $_POST['radios'] === "女性") {
                                                                                    echo 'checked';
                                                                                } ?>>女性</li>
                        </ul>
                    </div>
                    <div class="inquiry-texts">
                        <div class="inquiry-text">
                            <p class="is-error-name"></p>
                            <label class="inquery-text__item"><span>氏名</span><span class="require">必須</span></label>
                            <div><input type="text" name="name" value="<?php if (!empty($_POST['name'])) {
                                                                            echo $_POST['name'];
                                                                        } ?>"></div>
                        </div>
                        <div class="inquiry-text">
                            <p class="is-error-email"></p>
                            <label class="inquery-text__item"><span>メールアドレス</span><span class="require">必須</span></label>
                            <div><input type="email" name="email" value="<?php if (!empty($_POST['email'])) {
                                                                                echo $_POST['email'];
                                                                            } ?>"></div>
                        </div>
                        <div class="inquiry-text">
                            <label class="inquery-text__item"><span>コメント</span><span class="not-require">任意</span></label>
                            <div><textarea name="comment" cols="30" rows="10"><?php if (!empty($_POST['comment'])) {
                                                                                    echo $_POST['comment'];
                                                                                } ?></textarea></div>
                        </div>
                    </div>

                    <div class="submit-button">
                        <button>確認画面へ</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script type="text/javascript" src="validation.js"></script>
</body>

</html>