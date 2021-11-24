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

            $page = $_GET['page'] == '' ? 1 : $_GET['page'];

            $count_per_page = 5;

//            $query = $pdo->prepare('SELECT * FROM `articles` ORDER BY `created_at` DESC');
            $query = $pdo->prepare('SELECT * FROM `articles`');
            $query->execute();

            $count_articles = $query->rowCount();
            $page_count = ceil($count_articles / $count_per_page);
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            require 'functions.php';
            for ($i = $page*$count_per_page; $i < ($page+1)*$count_per_page; $i++) {

//                $sql = 'SELECT * FROM `articles` LIMIT ' . ($page - 1) . ', 3';
//                $query_records = $pdo->prepare($sql);
//                $query_records->execute();
//                $results = $query_records->fetchAll(PDO::FETCH_ASSOC);

                if ($results[$i - $count_per_page]['id'] != NULL) {
                    echo "<h2>" . $results[$i - $count_per_page]['title'] . "</h2>";
                    echo "<p>" . $results[$i - $count_per_page]['announce'] . "</p>";
                    echo "<p><b>Время публикации:</b> " . show_date($results[$i - $count_per_page]['created_at']) . "</p>";
                    echo "<a href='/news/article.php?id=" . $results[$i - $count_per_page]['id'] . "'>";
                    echo "<button class='btn btn-outline-success mb-5 mr-2'>Читать полностью</button>";
                    echo "<a>";
                }
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