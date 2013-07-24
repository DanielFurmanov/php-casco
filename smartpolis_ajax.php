<?php
  @set_time_limit(0);
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include_once(dirname(__FILE__) . '/smartpolis/settings.class.php');

  function sendFirstEmail() {
	$name  = htmlspecialchars(strip_tags($_POST['name']));
	$email = htmlspecialchars(strip_tags($_POST['email']));
	$phone = htmlspecialchars(strip_tags($_POST['phone']));
    $settings = new smartPolisSettings();
    $emlTitle = '[' . date('d.m.Y, H:i:s') . '] Умный Полис - начало расчёта';
    $emlBody = <<<EOF
Здравствуйте!
На сайте {$_SERVER['SERVER_NAME']} была запущена процедура расчёта стоимости полисов:

ФИО:        {$name}
E-mail:     {$email}
Телефон:    {$phone}
Информация: http://умный-полис.рф/#{$_SESSION['cascoResultId']}

--
С уважением,
почтовый робот сайта {$_SERVER['SERVER_NAME']}
EOF;
    $emlTitle   = '=?utf-8?B?' . base64_encode($emlTitle) . '?=';
    $emlBody    = chunk_split(base64_encode($emlBody));
    $emlTo      = '=?utf-8?B?' . base64_encode('Администратор “Умного Полиса”') . '?= <' . $settings->get('smartpolis_target_email') . '>';
    $emlHeaders = "MIME-Version: 1.0\r\n" .
		              "From: " . '=?utf-8?B?' . base64_encode('Умный Полис') . '?= <noreply@' . $_SERVER['SERVER_NAME'] . '>' . "\r\n" .
                  "Content-Type: text/plain; charset=utf-8\r\n" .
                  "Content-Transfer-Encoding: base64\r\n";
    mail($emlTo, $emlTitle, $emlBody, $emlHeaders);
  }

  $casco = new smartpolisCascoApi();

  $requestType = @$_REQUEST['type'];

  switch($requestType) {
    case 'car_models': {
      $casco->setValue('car_mark', $_REQUEST['car_mark']);
      echo $casco->getCarModels();
      break;
    }
    case 'car_modifications': {
      $casco->setValue('car_model', $_REQUEST['car_model']);
      echo $casco->getCarModifications();
      break;
    }
    case 'getRequarList': {
      $casco->setValue('car_modification', @$_REQUEST['smartpolis_car_modifications']=='' ? null: $_REQUEST['smartpolis_car_modifications']);
      $casco->setValue('car_cost', $_REQUEST['smartpolis_car_cost']);
      $casco->setValue('car_manufacturing_year', $_REQUEST['smartpolis_car_manufacturing_year']);
      if ( isset($_REQUEST['smartpolis_drivers_count']) && $_REQUEST['smartpolis_drivers_count']=='multiply') {
        $casco->setValue('is_multidrive', true);
        $casco->setValue('drivers_minimal_age', 18);
        $casco->setValue('drivers_minimal_experience', 0);
        $casco->setValue('drivers_count', null);
        $casco->setValue('driver_set', array());
      } else {
        $casco->setValue('is_multidrive', false);
        $casco->setValue('drivers_minimal_age', null);
        $casco->setValue('drivers_minimal_experience', null);
        $casco->setValue('drivers_count', count($_REQUEST['car_driver_age']));
        $drivers = array();
        foreach($_REQUEST['car_driver_age'] as $key=>$value) {
          $driver = array();
          $driver['age'] = $_REQUEST['car_driver_age'][$key];
          $driver['expirience'] = $_REQUEST['car_driver_prof'][$key];
          $driver['gender'] = $_REQUEST['car_driver_gender'][$key];
          $driver['is_married'] = false;
          $driver['has_children'] = false;
          $drivers[] = $driver;
        }
        $casco->setValue('driver_set', $drivers);
      }
      $casco->createResult();
      echo $casco->getActiveCompanies();
      break;
    }
    case 'getResult': {
      echo $casco->getResult($_REQUEST['id']);
      break;
    }
	case 'showResultList': {
		sendFirstEmail();
		echo '{"status": "success"}';
		break;
	}
    default: echo $casco->getCarMarks();
  }
?>
