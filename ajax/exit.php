<?php
setcookie('login', '', time() - 3600 * 24 * 30, '/news/');
unset($_COOKIE['login']);
echo true;