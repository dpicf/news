<?php
    if($_COOKIE['login'] != 'admin') {
        header('Location: /news/auth.php');
        exit();
    }
?>

<?php
$website_title = 'Добавление новости';
require_once 'blocks/head.php'
?>

<?php require_once 'blocks/header.php'?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-5">Добавление новости</h4>
            <form action="" method="post">
                <label for="title">Заголовок новости</label>
                <input type="text" name="title" id="title" class="form-control">

                <label for="announce" class="mt-4">Анонс новости</label>
                <textarea name="announce" id="announce" class="form-control" rows="4"></textarea>

                <label for="body" class="mt-4">Текст новости</label>
                <textarea name="body" id="body" class="form-control" rows="10"></textarea>

                <div class="alert alert-danger  mt-2" id="error_block"></div>

                <button type="button" id="add_article" class="btn btn-success mt-5">Добавить</button>
            </form>
        </div>
    </div>
</main>

<script>
    $('#add_article').click(function () {
        let title = $('#title').val();
        let announce = $('#announce').val();
        let body = $('#body').val();

        $.ajax({
            url: 'ajax/ajax_add_article.php',
            type: 'POST',
            cache: false,
            data: {'title': title, 'announce': announce, 'body': body},
            dataType: 'html',
            success: function(data) {
                if (data.indexOf('Введите') === -1) {
                    document.location.href = '/news/article.php?id=' + data;
                } else {
                    $('#error_block').show().text(data);
                }
            }
        })
    });
</script>