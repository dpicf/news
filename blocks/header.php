<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Честные Новости</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a href="/news/" class="p-2">Все новости</a>
        <?php
            if($_COOKIE['login'] == 'admin') {
                echo "<a href='/news/add_article.php' class='p-2'>Добавить новость</a>";
            }
        ?>
    </nav>
    <?php if($_COOKIE['login'] != 'admin'): ?>
        <a href="/news/auth.php" class='p-2'>Войти</a>
<!--    <a class="btn btn-outline-primary mr-2" href="/news/auth.php">Войти</a>-->
<!--    <a class="btn btn-outline-primary" id="reg" href="/news/reg.php">Регистрация</a>-->
    <?php else: ?>
        <button class="btn btn-outline-primary" id="exit_button">Выйти</button>
    <?php endif; ?>
</div>

<script>
    $('#exit_button').click(function () {
        $.ajax({
            url: 'ajax/exit.php',
            type: 'POST',
            cache: false,
            data: {},
            dataType: 'html',
            success: function() {
                document.location.reload(true);
            }
        })
    });
</script>