<?php

if($_COOKIE['login'] != 'admin') {
    header('Location: /news/auth.php');
    exit();
}

require 'connect.php';
global $pdo;

$sql = 'SELECT * FROM `articles` WHERE `id` = :id';
$query = $pdo->prepare($sql);
$query->execute(['id' => $_GET['id']]);

$article = $query->fetch(PDO::FETCH_OBJ);

$website_title = 'Редактирование';
require 'blocks/head.php';
?>

<?php require 'blocks/header.php'?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-5">Добавление новости</h4>
            <form action="" method="post">
                <label for="title">Заголовок новости</label>
                <input type="text" name="title" id="title" class="form-control"
                       value="<?= $article->title ?>">

                <label for="announce" class="mt-4">Анонс новости</label>
                <textarea name="announce" id="announce" class="form-control"
                          rows="4"><?= $article->announce ?></textarea>

                <label for="body" class="mt-4">Текст новости</label>
                <textarea name="body" id="body" class="form-control" rows="10"><?= $article->body ?></textarea>

                <div class="alert alert-danger mt-2" id="error_block"></div>

                <button type="button" id="edit_article" class="btn btn-success mt-5 mr-3">Готово</button>
                <a href="/news/article.php?id=<?= $article->id ?>" class='text-decoration-none'>
                    <button type="button" id="edit_article" class="btn btn-outline-danger mt-5">Отменить</button>
                </a>
            </form>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $('#edit_article').click(function () {
        let id = '<?php echo $article->id ?>';

        let title = $('#title').val();
        let oldTitle = '<?php echo $article->title ?>';

        let announce = $('#announce').val();
        let oldAnnounce = '<?php echo $article->announce ?>';

        let body = $('#body').val();
        let oldBody = '<?php echo $article->body ?>';

        let created_at = '<?php echo $article->created_at ?>';

        if (title != oldTitle || announce != oldAnnounce || body != oldBody) {
            $.ajax({
                url: 'ajax/ajax_edit_article.php',
                type: 'POST',
                cache: false,
                data: {'id': id, 'title': title, 'announce': announce, 'body': body, 'created_at': created_at},
                dataType: 'html',
                success: function(data) {
                    if (data.indexOf('Введите') === -1) {
                        document.location.href = '/news/article.php?id=' + data;
                    } else {
                        $('#error_block').show().text(data);
                    }
                }
            })
        } else {
            $('#error_block').show().text('Вы не изменили запись');
        }
    });
</script>