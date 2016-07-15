<?php
define("ITFORM_LOGIN", 'demowebcalc@test.ru');
define("ITFORM_PASSWORD", 'a8f15a4ff');

//Удалите старый файл если изменили логин и пароль
//Измените имя файла вкотором храниться токен!!!
define("ITFORM_TOKEN_FILE", 'youbetterkeepitisdfsdfsdf535nsercet');

//Закоментируйте что бы спользовать mail();
function ItSetAuth($mail)
{
    $mail->isMail();
}


