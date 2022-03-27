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

<div id="deliveryDistanceRate"></div>
<div style="background-color:#ffffff;" class="container margin_60">
  <div class="row"> 
    <div class="col-md-8 col-md-offset-2"> 
      <div class="indent_title_in">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <h3>Raio de Entrega:</h3>
      </div>
<a class="btn btn-primary" href="https://www.youtube.com/channel/UCUVhSNdrLyQ64i123Uc8btg/videos>" target="_blank"></i><span class="float-right text-center font-w-700"><strong>TUTORIAL</strong></a>
      <?php
        $deliveryDistanceRateID = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if(!empty($deliveryDistanceRateID)):
          $lerbanco->ExeRead('delivery_distance_rate', "WHERE user_id = :user_id AND id = :delivery_distance_rate_id", "user_id={$userlogin['user_id']}&delivery_distance_rate_id={$deliveryDistanceRateID}");
          if ($lerbanco->getResult()):
            $deletbanco->ExeDelete("delivery_distance_rate", "WHERE user_id = :user_id AND id = :delivery_distance_rate_id", "user_id={$userlogin['user_id']}&delivery_distance_rate_id={$deliveryDistanceRateID}");
            if ($deletbanco->getResult()):
              echo "
                <div class=\"alert alert-success alert-dismissable\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <b class=\"alert-link\">SUCESSO!</b> Raio de entrega deletado do sistema.
                </div>
              ";

              header("Refresh: 3; url={$site}{$Url[0]}/delivery-distance-config");
            else:
              echo "
                <div class=\"alert alert-danger alert-dismissable\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <b class=\"alert-link\">OCORREU UM ERRO DE CONEXÃO!</b> Tente novamente.
                </div>
              ";

              header("Refresh: 3; url={$site}{$Url[0]}/delivery-distance-config");
            endif;
          endif;
        endif;

        $addDeliveryDistanceRate = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($addDeliveryDistanceRate && isset($addDeliveryDistanceRate['send_delivery_distance_rate'])):
          unset($addDeliveryDistanceRate['send_delivery_distance_rate']);

          if (!isset($addDeliveryDistanceRate['distance_rate']) || !preg_match('~^[0-9]+$~', $addDeliveryDistanceRate['distance_rate'])):
            echo "
              <div class=\"alert alert-info alert-dismissable\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                A distância deve ser em quilômetros (inteiro).
              </div>
            ";
          else:
            $addDeliveryDistanceRate['price'] = Check::Valor($addDeliveryDistanceRate['price']);

            $lerbanco->ExeRead('delivery_distance_rate', "WHERE user_id = :user_id AND distance_rate = :distance_rate", "user_id={$userlogin['user_id']}&distance_rate={$addDeliveryDistanceRate['distance_rate']}");
            if (!$lerbanco->getResult()):   
              $addbanco->ExeCreate("delivery_distance_rate", $addDeliveryDistanceRate);
              if ($addbanco->getResult()):
                echo "
                  <div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b class=\"alert-link\">SUCESSO!</b> Raio de entrega inserido no sistema.
                  </div>
                ";
              else:
                echo "
                  <div class=\"alert alert-danger alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <b class=\"alert-link\">OCORREU UM ERRO TENTE NOVAMENTE!</b> Tente novamente.
                  </div>
                ";
              endif;
            else:
              echo "
                <div class=\"alert alert-info alert-dismissable\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  Você já cadastrou este raio de entrega!
                </div>
              ";
            endif;
          endif;
        endif;
      ?>
      <form class="form-horizontal" action="#addDeliveryDistanceRate" role="form" method="post">
        <br />
        <div class="form-group">
          <label class="col-sm-2 control-label">Km:</label>
          <div class="col-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
              <input type="text" required name="distance_rate" class="form-control" placeholder="Raio de distância...">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Taxa:</label>
          <div class="col-sm-10">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
              <input type="text" required name="price" maxlength="11" onkeypress="return formatar_moeda(this, '.', ',', event);" data-mask="#.##0,00" data-mask-reverse="true" class="form-control" placeholder="0,00">
            </div>
          </div>
        </div>
        <input type="hidden" name="user_id" value="<?php $userlogin['user_id'];?>">
        <input type="submit" name="send_delivery_distance_rate" value="Cadastrar" class="btn btn-success" />
        <br />
        <br />
        <div class="form-group">
          <div class="table-responsive" id="search">
            <table data-sortable class="table table-hover table-striped">
              <thead>
                <tr>            
                  <th>Raio</th>
                  <th>Taxa</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $lerbanco->ExeRead("delivery_distance_rate", "WHERE user_id = :user_id ORDER BY distance_rate", "user_id={$userlogin['user_id']}");
                  if($lerbanco->getResult()):
                    foreach($lerbanco->getResult() as $tt):
                      extract($tt);                                    
                ?>
                      <tr>
                        <td><strong><?php $distance_rate . ' Km';?></strong></td>
                        <td><strong><?php 'R$ ' . Check::real($price);?></strong></td>
                        <td align ="right">
                          <a title="Remover" href="<?php $site.$Url[0].'/delivery-distance-config&delete='.$id.'#addDeliveryDistanceRate';?>">
                            <button style="margin-top: 3px;" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                          </a>
                        </td>
                      </tr>
                <?php
                    endforeach;
                  endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
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