<?php
/**
 * Это обычная страница сайта, на которой размещается модуль.
 *
 * Для подключения модуля “Умный полис” используются две функции:
 *   smartpolis_write_head() - отображает необходимый код в head-секции
 *   smartpolis_write_body() - отображает, собственно, сам модуль.
 */

require_once(dirname(__FILE__) . '/smartpolis/include.php');

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <? smartpolis_write_head(); ?>
    <title>Умный полис</title>
</head>
<body>
    <? smartpolis_write_body(); ?>
</body>
</html>