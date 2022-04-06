$(function () {
    //フォーム指定
    $('form').validate({

        //検証ルール設定
        rules: {
            //ここに検証ルールを設定
            'checks[]': {
                required: true,
            },
            chance: {
                required: true,
            },

            radios: {
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
        },

        //エラーメッセージ設定
        messages: {
            //ここにエラーメッセージを設定
            'checks[]': {
                required: 'お問合せ内容を選択してください',
            },
            chance: {
                required: '知ったきっかけを選択してください',
            },
            radios: {
                required: '性別を選択してください',
            },
            name: {
                required: '名前を入力してください',
            },
            email: {
                required: 'メールアドレスを入力してください',
                email: 'メールアドレスの形式で入力してください',
            }

        },
        // エラーメッセージ出力箇所
        errorPlacement: function (error, element) {
            var name = element.attr('name');
            if (element.attr("name") == 'checks[]') {
                error.appendTo(".is-error-checks");
            } else {
                error.appendTo($('.is-error-' + name))
            }
        },

        errorElement: "span",
        errorClass: "is-error",

    });
});







$(function () {
    //フォーム指定
    $('form').validate({

        //検証ルール設定
        rules: {
            //ここに検証ルールを設定
            'checks[]': {
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
        },

        //エラーメッセージ設定
        messages: {
            //ここにエラーメッセージを設定
            'checks[]': {
                required: 'お問合せ内容を選択してください',
            },
            name: {
                required: '名前を入力してください',
            },
            email: {
                required: 'メールアドレスを入力してください',
                email: 'メールアドレスの形式で入力してください',
            }

        },
        // エラーメッセージ出力箇所
        errorPlacement: function (error, element) {
            var name = element.attr('name');
            if (element.attr("name") == 'checks[]') {
                error.appendTo(".is-error-checks");
            } else {
                error.appendTo($('.is-error-' + name))
            }
        },

        errorElement: "span",
        errorClass: "is-error",

    });
});

