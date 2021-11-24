<?php

require 'connect.php';
global $pdo;

$sql = 'SELECT * FROM `articles` WHERE `id` = :id';
$query = $pdo->prepare($sql);
$query->execute(['id' => $_GET['id']]);

$article = $query->fetch(PDO::FETCH_OBJ);

$website_title = $article->title;
require 'blocks/head.php';

?>

<?php require 'blocks/header.php'?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="jumbotron">
                <h1><?=$article->title?></h1>
                <p><?php
                    require 'functions.php';
                    echo "<b>Время публикации:</b> " . show_date($article);
                ?></p>
                <p>
                    <?=$article->announce?>
                    <br><br>
                    <?=$article->body?>
                </p>
            </div>

            <div class="alert alert-danger  mt-2" id="error_block"></div>

            <?php if($_COOKIE['login'] == 'admin'): ?>
                <button class='btn btn-primary mb-5 mr-2'>Редактировать</button>
                <button class='btn btn-danger mb-5' id='delete'>Удалить</button>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
    $('#delete').click(function () {
        if (confirm("Удалить?")) {
            let id = '<?php echo $article->id ?>';

            $.ajax({
                url: 'ajax/delete.php',
                type: 'POST',
                cache: false,
                data: {'id': id},
                dataType: 'html',
                success: function(data) {
                    if (data == 'Готово') {
                        document.location.href = "/news/";
                    } else {
                        $('#error_block').show().text(data);
                    }
                }
            })
        }
    });
</script>