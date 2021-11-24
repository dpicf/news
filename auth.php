<?php
$website_title = 'Авторизация';
require 'blocks/head.php'
?>

<?php require 'blocks/header.php'?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-5">Форма авторизации</h4>
            <form action="" method="post">
                <label for="login">Логин</label>
                <input type="text" name="login" id="login" class="form-control">

                <label for="password" class="mt-4">Пароль</label>
                <input type="password" name="password" id="password" class="form-control">

                <div class="alert alert-danger  mt-2" id="error_block"></div>

                <button type="button" id="auth_user" class="btn btn-success mt-5">Войти</button>
            </form>
        </div>
    </div>
</main>

<script>
    $('#auth_user').click(function () {
        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url: 'ajax/ajax_auth.php',
            type: 'POST',
            cache: false,
            data: {'login': login, 'password': password},
            dataType: 'html',
            success: function(data) {
                if (data == 'Готово') {
                    document.location.href = "/news/";
                } else {
                    $('#error_block').show().text(data);
                }
            }
        })
    });
</script>