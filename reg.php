<?php
$website_title = 'Регистрация';
require_once 'blocks/head.php'
?>

<?php require_once 'blocks/header.php'?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-5">Форма регистрации</h4>
            <form action="" method="post">
                <label for="username">Ваше имя</label>
                <input type="text" name="username" id="username" class="form-control">

                <label for="email" class="mt-4">Email</label>
                <input type="email" name="email" id="email" class="form-control">

                <label for="login" class="mt-4">Логин</label>
                <input type="text" name="login" id="login" class="form-control">

                <label for="password" class="mt-4">Пароль</label>
                <input type="password" name="password" id="password" class="form-control">

                <div class="alert alert-danger  mt-2" id="error_block"></div>

                <button type="button" id="reg_user" class="btn btn-success mt-5">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</main>

<script>
    $('#reg_user').click(function () {
        let username = $('#username').val();
        let email = $('#email').val();
        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url: 'ajax/ajax_reg.php',
            type: 'POST',
            cache: false,
            data: {'username': username, 'email': email, 'login': login, 'password': password},
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