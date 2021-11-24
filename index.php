<?php
    $website_title = 'Новости';
    require 'blocks/head.php'
?>

<?php require 'blocks/header.php'?>

<main class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <?php
                require 'connect.php';
                global $pdo;

                $sql = 'SELECT * FROM `articles` ORDER BY `created_at` DESC';
                $query = $pdo->query($sql);

                require 'functions.php';
                while($article = $query->fetch(PDO::FETCH_OBJ)) {
                    echo "<h2>$article->title</h2>";
                    echo "<p>$article->announce</p>";
                    echo "<p><b>Время публикации:</b> " . show_date($article->created_at) . "</p>";
                    echo "<a href='/news/article.php?id=$article->id' title='$article->title'>";
                    echo "<button class='btn btn-warning mb-5 mr-2'>Читать полностью</button>";
                    echo "<a>";
                }
            ?>
        </div>
    </div>
</main>