<?php
/**
 * Фасад модуля “Умный полис”
 *
 */

require_once(dirname(__FILE__) . '/settings.class.php');

function smartpolis_write_head($includeJQuery = true) {
    echo '<link rel="stylesheet" href="smartpolis/css/smartpolis.css" />' . "\n";
    echo '<link rel="stylesheet" href="smartpolis/css/style.css" />' . "\n";
    if ($includeJQuery)
        echo '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>' . "\n";
    echo '<script type="text/javascript" src="smartpolis/js/smartpolis.js"></script>' . "\n";
}

function smartpolis_write_body() {
    $settings = new smartPolisSettings();
    $smartpolis_show_type = $settings->get('smartpolis_show_type');

    if (!empty($_POST)) {
        $emlTitle = '[' . date('d.m.Y, H:i:s') . '] Умный Полис - новая заявка';

        $fio      = htmlspecialchars(strip_tags($_POST['fio']));
        $phone    = htmlspecialchars(strip_tags($_POST['phone']));
        $date     = htmlspecialchars(strip_tags($_POST['date']));
        $iwant    = htmlspecialchars(strip_tags($_POST['iwant']));
        $address  = htmlspecialchars(strip_tags($_POST['address']));
        $comments = htmlspecialchars(strip_tags($_POST['comments']));

        $emlBody = <<<EOF
Здравствуйте!
На сайте {$_SERVER['SITE_NAME']} была заполнена форма “Умный полис”:

ФИО:                    {$fio}
Телефон:                {$phone}
Дата оформления полиса: {$date}
Способ доставки:        {$iwant}
Адрес:                  {$address}
Комментарии:            {$comments}

--
С уважением,
почтовый робот сайта {$_SERVER['SITE_NAME']}
EOF;

        $emlTitle   = '=?utf-8?B?' . base64_encode($emlTitle) . '?=';
        $emlBody    = chunk_split(base64_encode($emlBody));
        $emlTo      = '=?utf-8?B?' . base64_encode('Администратор “Умного Полиса”') . '?= <' . $settings->get('smartpolis_target_email') . '>';
        $emlHeaders = "MIME-Version: 1.0\r\n" .
                      "Content-Type: text/plain; charset=utf-8\r\n" .
                      "Content-Transfer-Encoding: base64\r\n";

        mail($emlTo, $emlTitle, $emlBody, $emlHeaders);
        ?>
            <div class="smartpolis_result">
                Ваша заявка успешно отправлена!
            </div>
        <?
    }
    ?>
        <div class="smartpolis_before_info">
          <?php echo $settings->get('smartpolis_message_before_button'); ?>
        </div>
        <div class="blok">
          <form id="smartpolis_car_form">
            <input type="hidden" name="type" value="getRequarList" />
            <input type="hidden" name="smartpolis_show_type" value="<?php echo $smartpolis_show_type; ?>" />
            <table class="table1" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><div class="bl"><label class="smartpolis_car_form_label">Марка автомобиля</label><select class="" name="smartpolis_car_marks" id="smartpolis_car_marks"><option></option></select></div></td>
                <td><div class="bl"><label class="smartpolis_car_form_label">Модель автомобиля</label><select class="" name="smartpolis_car_models" id="smartpolis_car_models"><option></option></select></div></td>
                <td><div class="bl"><label class="smartpolis_car_form_label">Модификация автомобиля</label><select class="" name="smartpolis_car_modifications" id="smartpolis_car_modifications"><option></option></select></div></td>
              </tr>
              <tr>
                <td><div class="bl"><label class="smartpolis_car_form_label">Стоимость автомобиля</label><input type="text" class="pole"  id="smartpolis_car_cost" name="smartpolis_car_cost" value="0" /></div></td>
                <td><div class="bl"><label class="smartpolis_car_form_label">Год выпуска автомобиля</label><select class=""  name="smartpolis_car_manufacturing_year" id="smartpolis_car_manufacturing_year">
                <?php
                  for( $i=date('Y'); $i>=2005; $i--) {
                    echo '<option value="' . $i . '">' . $i . ' г.в.</option>';
                  }
                ?>
                </select></div>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div class="bl w100"><label class="smartpolis_car_form_label">Количество водителей</label><select class="w100" name="smartpolis_drivers_count" id="smartpolis_drivers_count">
                  <option value="1" selected>Один</option>
                  <option value="2">Два</option>
                  <option value="3">Три</option>
                  <option value="4">Четыре</option>
                  <option value="5">Пять</option>
                  <option value="multiply">Мультидрайв</option>
                </select></div></td>
                <td colspan="2" id="smartpolis_drivers_set"></td>
              </tr>
            </table>
            <?php
              if ( $smartpolis_show_type == 'show_after_form' || $smartpolis_show_type== 'send_by_letter') { ?>
              <div class="b-gray" id="smartpolis_contact_form">
                <div class="left">
                  <table cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="2"><label>Ваше имя</label><input name="" type="text" class="pole" id="smartpolis_client_name" /></td>
                    </tr>
                    <tr>
                      <td><label>Email</label><input name="" type="text" class="pole" id="smartpolis_client_email"/></td>
                      <td><label>Контактный телефон</label><input name="" type="text" class="pole" id="smartpolis_client_phone" /></td>
                    </tr>
                  </table>
                </div><!--end left-->
                <div class="right">
                  <?php echo $settings->get('smartpolis_header_before_form'); ?>
                </div><!--end right-->
              </div><!--end b-gray-->
              <?php
              }
            ?>
            <div class="b-rasch">
              <input class="but" name="" type="submit" value=" " />
            </div><!--end b-rasch-->
            <br />
          </form>
          <div id='smartpolis_message_before_form'>
            <?php echo $settings->get('smartpolis_message_before_form'); ?>
            <br/>
            <span id="smartpolis_wait_count_result"></span>
          </div>
          <div class="table-tarif" id="smartpolis_result">
          </div><!--end table-tarif-->
        </div><!--end blok-->
          <div id='smartpolis_order_form'>
            <h3 class='smartpolis_order_form_title'>Заявка на получение полиса</h3>
            <form method="post">
            <table>
              <tr>
                <td>Ваше имя<br/><input type="text" name="fio" /></td>
              </tr>
              <tr>
                <td>Контактный телефон<br/><input type="text" name="phone" /></td>
              </tr>
              <tr>
                <td>Дата, с которой Вы хотите застраховать автомобиль<br/><input type="text" name="date" /></td>
              </tr>
              <tr>
                <td>Мне будет удобно:<br/>
                <input type="radio" name="iwant" value="Самовывоз" />Подъехать к Вам в офис и забрать оформленный полис КАСКО/ОСАГО<br/>
                <input type="radio" name="iwant" value="Доставка по адресу" />Получить полис по адресу:<br/>
                <textarea name="address"></textarea><br/>
                <span>(Доставка полиса КАСКО производится бесплатно)</span>
                </td>
              </tr>
              <tr>
                <td>Примечания к заказу:<br/>
                <textarea name="comments"></textarea></td>
              </tr>
              <tr>
                <td>
                  <button id="smartpolis_order_form_close">Закрыть</button>
                  <button id="smartpolis_order_form_submit" type="submit">Отправить</button>
                  </td>
              </tr>

            </table>
            </form>
          </div>
    <?
}

?>