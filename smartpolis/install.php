<?php
/**
 * Смена пароля
 *
 */

header('Content-type: text/html; charset=utf-8');

function strRand($str, $count = 1) {
    $res = '';
    for ($i = 0; $i < $count; ++$i)
        $res .= $str[rand(0, strlen($str) - 1)];
    return $res;
}

$numeric  = '0123456789';
$alpha    = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ';
$symbol   = '-_{}()';
$login    = strRand($alpha) . strRand($alpha . $numeric, 7);
$password = strRand($alpha . $numeric . $symbol, 8);

$htaccess = file_get_contents(dirname(__FILE__) . '/.htaccess');
file_put_contents(dirname(__FILE__) . '/.htaccess', preg_replace('/AuthUserFile (.*?)$/m', 'AuthUserFile ' . dirname(__FILE__) . '/.htpasswd', $htaccess));

file_put_contents(dirname(__FILE__) . '/.htpasswd', $login . ':' . crypt($password, 'apr'));

?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="ru"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ru"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Установка - Умный Полис</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/foundation.css">
    <script src="js/vendor/custom.modernizr.js"></script>
</head>
<body class="antialiased">
    <nav class="top-bar">
        <ul class="title-area">
            <li class="name">
                <h1><a href="../">Умный Полис</a></h1>
            </li>
        </ul>
    </nav>
    <div class="row">
        <h2>Установка пароля администратора модуля</h2>
        <h4 class="subheader">Пожалуйста, в&nbsp;целях безопасности, не&nbsp;забудьте записать данные, указанные ниже, и&nbsp;удалить файл <?=__FILE__?></h4>
        <fieldset>
            <legend>Параметры входа в раздел администрирования</legend>
            <div class="row">
                <label>URL панели управления</label>
                <input type="text" disabled="disabled" value="http://<?=$_SERVER['SERVER_NAME'] . preg_replace('#install.php$#', 'index.php', $_SERVER['REQUEST_URI'])?>">
            </div>
            <div class="row">
                <label>Логин</label>
                <input type="text" disabled="disabled" value="<?=$login?>">
            </div>
            <div class="row">
                <label>Пароль</label>
                <input type="text" disabled="disabled" value="<?=$password?>">
            </div>
        </fieldset>
    </div>
</body>
</html>