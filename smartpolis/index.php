<?php
/**
 * Модуль “Умный полис” - административный интерфейс модуля
 *
 */

require_once(dirname(__FILE__) . '/settings.class.php');
$settings = new smartPolisSettings();

?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="ru"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ru"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Администрирование - Умный Полис</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/foundation.css">
    <script src="js/vendor/custom.modernizr.js"></script>
</head>
<body>
    <nav class="top-bar">
        <ul class="title-area">
            <li class="name">
                <h1><a href="../">Умный Полис</a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span>Меню...</span></a></li>
        </ul>
        <section class="top-bar-section">
            <ul class="right">
                <li class="divider"></li>
                <li><a href="./">Параметры</a></li>
                <li class="divider"></li>
                <li><a href="./?companies">Компании</a></li>
            </ul>
        </section>
    </nav>
    <? if (isset($_GET['companies'])) { ?>
        <div class="row">
            <div class="large-12 columns">
                <h2>Компании</h2>
            </div>
        </div>
        <?
            if (!empty($_POST)) {
                if (isset($_POST['save'])) {
                    foreach ($_POST['smartpolis_companies'] as $id => $info) {
                        $settings->setCompanyParams($id, $info['active'], $info['discount']);
                    }
                    $settings->save();
                    ?>
                        <div class="row">
                            <div class="large-12 columns">
                                <div data-alert="" class="alert-box success">
                                    Параметры успешно сохранены
                                    <a href="" class="close">×</a>
                                </div>
                            </div>
                        </div>
                    <?
                }
                if (isset($_POST['update'])) {
                    $settings->updateCompanies();
                    ?>
                        <div class="row">
                            <div class="large-12 columns">
                                <div data-alert="" class="alert-box success">
                                    Данные о компаниях обновлены
                                    <a href="" class="close">×</a>
                                </div>
                            </div>
                        </div>
                    <?
                }
            }
        ?>
        <div class="row">
            <div class="large-12 columns">
                <form class="custom" method="post">
                    <fieldset>
                        <legend>Страховые компании</legend>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Логотип</th>
                                    <th>Название</th>
                                    <th>Скидка</th>
                                    <th>Активность</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                    $companies = $settings->get('smartpolis_companies');
                                    foreach ($companies as $id => $company) {
                                        $active = $company['params']['active'] == 'true';
                                        ?>
                                            <tr>
                                                <td align="center"><input type="checkbox" name="smartpolis_companies[<?=$id?>][active]"<?=$active ? ' checked="checked"' : ''?>></td>
                                                <td><img src="http://casco.cmios.ru/<?=$company['object']->logo?>" alt="<?=$company['object']->title?>"></td>
                                                <td><?=$company['object']->title?></td>
                                                <td><input type="text" name="smartpolis_companies[<?=$id?>][discount]" value="<?=$company['params']['discount']?>"</td>
                                                <td align="center">
                                                    <?if ($active) {?>
                                                        <span class="success label">Активна</span>
                                                    <?} else {?>
                                                        <span class="alert label">Отключена</span>
                                                    <?}?>
                                                </td>
                                            </tr>
                                        <?
                                    }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <fieldset>
                        <button type="submit" class="button" name="save">Сохранить</button>
                        <button type="submit" class="button" name="update">Обновить</button>
                    </fieldset>
                </form>
            </div>
        </div>
    <? } else { ?>
        <div class="row">
            <div class="large-12 columns">
                <h2>Параметры</h2>
            </div>
        </div>
        <?
            if (!empty($_POST)) {
                $settings->set($_POST);
                $settings->save();
                ?>
                    <div class="row">
                        <div class="large-12 columns">
                            <div data-alert="" class="alert-box success">
                                Параметры успешно сохранены
                                <a href="" class="close">×</a>
                            </div>
                        </div>
                    </div>
                <?
            }
        ?>
        <div class="row">
            <div class="large-12 columns">
                <form class="custom" method="post">
                    <fieldset>
                        <legend>Подключение сервиса расчетов</legend>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="smartpolis_auth_type_by_ip">
                                    <input name="smartpolis_auth_type" type="radio" value="by_ip" id="smartpolis_auth_type_by_ip"<?=$settings->get('smartpolis_auth_type') === 'by_ip' ? ' checked="checked"' : ''?> style="display:none">
                                    <span class="custom radio<?=$settings->get('smartpolis_auth_type') === 'by_ip' ? ' checked' : ''?>"></span> Авторизация по IP
                                </label>
                                <label for="smartpolis_auth_type_by_token">
                                    <input name="smartpolis_auth_type" type="radio" value="by_token" id="smartpolis_auth_type_by_token"<?=$settings->get('smartpolis_auth_type') === 'by_token' ? ' checked="checked"' : ''?> style="display:none">
                                    <span class="custom radio<?=$settings->get('smartpolis_auth_type') === 'by_token' ? ' checked' : ''?>"></span> Авторизация по ключу
                                </label>
                                <br>
                                <label for="smartpolis_auth_token">Ключ</label>
                                <input type="text" name="smartpolis_auth_token" id="smartpolis_auth_token" placeholder="Введите секретный ключ, полученный в настройках Вашего аккаунта на сайте умный-полис.рф" value="<?=$settings->get('smartpolis_auth_token')?>">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Режим работы</legend>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="smartpolis_show_type_form_after_show">
                                    <input name="smartpolis_show_type" type="radio" value="form_after_show" id="smartpolis_show_type_form_after_show"<?=$settings->get('smartpolis_show_type') === 'form_after_show' ? ' checked="checked"' : ''?> style="display:none">
                                    <span class="custom radio<?=$settings->get('smartpolis_show_type') === 'form_after_show' ? ' checked' : ''?>"></span> Заявка после отображения тарифов
                                </label>
                                <label for="smartpolis_show_type_show_after_form">
                                    <input name="smartpolis_show_type" type="radio" value="show_after_form" id="smartpolis_show_type_show_after_form"<?=$settings->get('smartpolis_show_type') === 'show_after_form' ? ' checked="checked"' : ''?> style="display:none">
                                    <span class="custom radio<?=$settings->get('smartpolis_show_type') === 'show_after_form' ? ' checked' : ''?>"></span> Отображение тарифов после оформления заявки
                                </label>
                                <label for="smartpolis_show_type_send_by_letter">
                                    <input name="smartpolis_show_type" type="radio" value="send_by_letter" id="smartpolis_show_type_send_by_letter"<?=$settings->get('smartpolis_show_type') === 'send_by_letter' ? ' checked="checked"' : ''?> style="display:none">
                                    <span class="custom radio<?=$settings->get('smartpolis_show_type') === 'send_by_letter' ? ' checked' : ''?>"></span> Отправка предложения с тарифами на почту
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Сообщения</legend>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="smartpolis_message_before_button">Текст перед калькулятором</label>
                                <textarea id="smartpolis_message_before_button" placeholder="Текст, отображаемый перед формой калькулятора" name="smartpolis_message_before_button"><?=$settings->get('smartpolis_message_before_button')?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="smartpolis_header_before_form">Поле 2</label>
                                <textarea id="smartpolis_header_before_form" placeholder="Поле 2" name="smartpolis_header_before_form"><?=$settings->get('smartpolis_header_before_form')?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="smartpolis_message_before_form">Текст перед результатами расчета</label>
                                <textarea id="smartpolis_message_before_form" placeholder="Этот текст появляется после нажатия на кнопку рассчитать, не отображается в третьем режиме" name="smartpolis_message_before_form"><?=$settings->get('smartpolis_message_before_form')?></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>E-mail для отправки заявок</legend>
                        <div class="row">
                            <div class="large-12 columns">
                                <input type="text" name="smartpolis_target_email" value="<?=$settings->get('smartpolis_target_email')?>" placeholder="Адрес E-mail, на который будут отправляться заявки">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <button type="submit" class="button">Сохранить</button>
                    </fieldset>
                </form>
            </div>
        </div>
    <? } ?>
    <script type="text/javascript">
    <!--
        document.write('<script type="text/javascript" src="' +
            ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
                '.js"><\/script>');
    //-->
    </script>
    <script src="js/foundation.min.js"></script>
    <script type="text/javascript">
    <!--
        $(document).foundation();
    //-->
    </script>
</body>
</html>
