<?php
require_once ('private.php');

define("ITFORM_DEBUG", true);

function ItSetUpMailData($json)
{

}

function ItSetUpMail($mail)
{
    $mail->setFrom('robot@itform.kasko');
    $mail->CharSet = 'UTF-8';
}

function ItSetUpBody($json, $mail)
{
    if($json->type === 'report') {
    $address = '4mebox@gmail.com';
    $subject = 'Заявка на страхование с сайта';

$text = <<<HERE
Поступила заявка на страхование Каско, параметры договора вы можете посмотреть по ссылке: http://enter.b2bpolis.ru/#/calculator/{$json->calculationId}/result/{$json->resultId}/formation_policy
Данные заказчика: {$json->name}, тел. {$json->phone}, адрес доставки: {$json->address}
Выбранный способ получения полиса: {$json->delivery}

Параметры расчета:
Марка/модель ТС: {$json->car_mark} {$json->car_model}
Год выпуска ТС: {$json->car_manufacturing_year}
Стоимость ТС: {$json->car_cost}
Водители:  {$json->drivers}
Кредит: {$json->credit_bank}
Рассрочка: {$json->contributory_scheme}
HERE;
    } else {
    $address = $json->email;
    $subject = 'Расчет на сайте homepolis.ru';

$text = <<<HERE
Здравствуйте! Вы осуществили расчет на сайте название сайта
Параметры расчета:
Марка/модель ТС: {$json->car_mark} {$json->car_model}
Год выпуска ТС: {$json->car_manufacturing_year}
Стоимость ТС: {$json->car_cost}
Водители:  {$json->drivers}
Кредит: {$json->credit_bank}
Рассрочка: {$json->contributory_scheme}

Стоимость страхования: {$json->programSum}
Номер вашего расчета для обращения к нашим специалистам: {$json->resultId}

с уважением,
компания homepolis.ru
HERE;

    }
    $mail->addAddress($address);
    $mail->Subject = $subject;
    $mail->Body = $text;
}

if(ITFORM_DEBUG) {
    error_reporting(E_ALL);
}