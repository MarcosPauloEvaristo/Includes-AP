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
?>

<div id="deliveryDistanceType"></div>
<div style="background-color:#ffffff;" class="container margin_60">
  <div class="row"> 
    <div class="col-md-8 col-md-offset-2"> 
      <div class="indent_title_in">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <h3>Tipo:</h3>
      </div>
      <?php
        $addDeliveryDistanceType = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($addDeliveryDistanceType && isset($addDeliveryDistanceType['send_delivery_distance_type'])):
          unset($addDeliveryDistanceType['send_delivery_distance_type']);
        
          if (!isset($addDeliveryDistanceType['type'])):
            echo "
              <div class=\"alert alert-info alert-dismissable\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                O tipo informado não é válido.
              </div>
            ";
          else:
            $lerbanco->ExeRead('delivery_distance_config', "WHERE user_id = :user_id", "user_id={$userlogin['user_id']}");
            if (!$lerbanco->getResult()):   
              $addbanco->ExeCreate("delivery_distance_config", $addDeliveryDistanceType);
              if ($addbanco->getResult()):
                header("Location: {$site}{$Url[0]}/delivery-distance-config");
              else:
                echo "
                  <div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b class=\"alert-link\">OCORREU UM ERRO TENTE NOVAMENTE!</b> Tente novamente.
                  </div>
                ";
              endif;
            else:
              $updatebanco->ExeUpdate("delivery_distance_config", $addDeliveryDistanceType, "WHERE user_id = :user_id", "user_id={$getnovadatarenova['user_id']}");
              if ($updatebanco->getResult()):
                header("Location: {$site}{$Url[0]}/delivery-distance-config");
              else:
                echo "
                  <div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b class=\"alert-link\">OCORREU UM ERRO TENTE NOVAMENTE!</b> Tente novamente.
                  </div>
                ";
              endif;
            endif;
          endif;
        endif;
      ?>
      <form class="form-horizontal" action="#addDeliveryDistanceType" role="form" method="post">
        <br />
        <input type="hidden" name="user_id" value="<?php $userlogin['user_id'];?>">
        <div class="form-group">
          <select required class="form-control" name="type" id="type">
            <option value="district">Bairro</option>
            <option value="distance_rate">Raio Km</option>
          </select>
        </div>
        <input type="submit" name="send_delivery_distance_type" value="Configurar" class="btn btn-success" />
      </form>
      <br />
      <div class="alert alert-info fade in nomargin">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon-attach-3"></i> NOTAS!</h4>
        <p>
          <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Se não for inserido nenhum Raio de entrega aqui nessa página, o sistema vai tomar como base apenas "UF E CIDADE" cadastrado na página configurações! isso e aconselhado em cidades pequenas com uma taxa fixa de delivery.
        </p>
      </div>
    </div>
  </div>
</div>