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

            $page = empty($_GET['page']) ? 1 : $_GET['page'];

            $count_per_page = 5;

            $query_count = $pdo->prepare('SELECT * FROM `articles`');
            $query_count->execute();
            $count_articles = $query_count->rowCount();

            $page_count = ceil($count_articles / $count_per_page);

            $start = $page * $count_per_page - $count_per_page;
            $sql = 'SELECT * FROM `articles` ORDER BY `created_at` DESC LIMIT ' . $start . ', ' . $count_per_page;
            $query_records = $pdo->prepare($sql);
            $query_records->execute();
            $results = $query_records->fetchAll(PDO::FETCH_ASSOC);

            require 'functions.php';
            foreach ($results as $result) {
                echo "<h2>" . $result['title'] . "</h2>";
                echo "<p>" . $result['announce'] . "</p>";
                echo "<p><b>Время публикации:</b> " . show_date($result['created_at']) . "</p>";
                echo "<a href='/news/article.php?id=" . $result['id'] . "'>";
                echo "<button class='btn btn-outline-success mb-5 mr-2'>Читать полностью</button>";
                echo "<a>";
            }
            ?>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item" id="start">
                        <a class="page-link" href="?page=1" tabindex="-1">Начало</a>
                    </li>
                    <?php if ($page - 2 > 0): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page - 2 ?>"><?= $page - 2 ?></a></li>
                    <?php endif; ?>
                    <?php if ($page - 1 > 0): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>"><?= $page - 1 ?></a></li>
                    <?php endif; ?>
                    <li class="page-item active">
                        <p class="page-link"><?= $page ?><span class="sr-only">(current)</span></p>
                    </li>
                    <?php if ($page + 1 <= $page_count): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>"><?= $page + 1 ?></a></li>
                    <?php endif; ?>
                    <?php if ($page + 2 <= $page_count): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page + 2 ?>"><?= $page + 2 ?></a></li>
                    <?php endif; ?>
                    <li class="page-item" id="end">
                        <a class="page-link disabled" href="?page=<?= $page_count ?>">Конец</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>

<script>
    let page = "<?php echo $page; ?>";
    let page_count = "<?php echo $page_count; ?>";
    if (page == 1) {
        $("#start").addClass("disabled");
    } else if (page == page_count) {
        $("#end").addClass("disabled");
    }
</script>