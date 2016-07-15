<?php
define("ITFORM_LOGIN", 'itform-demo@b2bpolis.ru 111');
define("ITFORM_PASSWORD", 'q%3D%26d 111');

//Удалите старый файл если изменили логин и пароль
//Измените имя файла вкотором храниться токен!!!
define("ITFORM_TOKEN_FILE", 'youbetterkeepitisdfsdfsdf535nsercet');

//Закоментируйте что бы спользовать mail();
function ItSetAuth($mail)
{
    $mail->isMail();
}


