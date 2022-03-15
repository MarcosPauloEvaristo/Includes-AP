<?php

$login = new Login(3);

if(!$login->CheckLogin()):
  unset($_SESSION['userlogin']);
  header("Location: {$site}");
else:
  $userlogin = $_SESSION['userlogin'];
endif;

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if(!empty($logoff) && $logoff == true):
  $updateacesso = new Update;
  $dataEhora    = date('d/m/Y H:i');
  $ip           = get_client_ip();
  $string_last = array("user_ultimoacesso" => " Último acesso em: {$dataEhora} IP: {$ip} ");
  $updateacesso->ExeUpdate("ws_users", $string_last, "WHERE user_id = :uselast", "uselast={$userlogin['user_id']}");

  unset($_SESSION['userlogin']);
  header("Location: {$site}");
endif;

$updatebanco = new Update();

$lerbanco->ExeRead('delivery_distance_config', "WHERE user_id = :user_id", "user_id={$userlogin['user_id']}");
if ($lerbanco->getResult()):
  $delivery_distance_config_result = $lerbanco->getResult();
  if ($delivery_distance_config_result[0]['type'] == 'distance_rate'):
    include_once 'delivery-distance-rate.php';
  elseif ($delivery_distance_config_result[0]['type'] == 'district'):
    include_once 'enderecos-delivery.php';
  else:
    include_once 'delivery-distance-type.php';
  endif;
else:
  include_once 'delivery-distance-type.php';
endif;
?>
