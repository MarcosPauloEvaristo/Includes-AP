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

$pesquisar = filter_input(INPUT_GET, 's', FILTER_DEFAULT);    
$a = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$a = urldecode($a);
?>
<!-- INICIO DA TABELA DE SERVICOS -->
<div style="background-color:#ffffff;" class="container margin_60"> 
  <div class="indent_title_in">
    <i class="fa fa-cutlery" aria-hidden="true"></i>
    <h3>PEDIDOS!</h3>
    <p style="color: red;"><b><span>*</span> MANTENHA ESSA PAGINA ABERTA, SERÁ ATUALIZADA A CADA MINUTO!</b></p>
    <a class="btn btn-primary" href="https://www.youtube.com/channel/UCUVhSNdrLyQ64i123Uc8btg/videos>" target="_blank"></i><span class="float-right text-center font-w-700"><strong>TUTORIAL</strong></a>
  </div>
  
  <style type="text/css">
    #custom-search-input{
      padding: 3px;
      border: solid 1px #E4E4E4;
      border-radius: 6px;
      background-color: #fff;
    }

    #custom-search-input input{
      border: 0;
      box-shadow: none;
    }

    #custom-search-input button{
      margin: 2px 0 0 0;
      background: none;
      box-shadow: none;
      border: 0;
      color: #666666;
      padding: 0 8px 0 10px;
      border-left: solid 1px #ccc;
    }

    #custom-search-input button:hover{
      border: 0;
      box-shadow: none;
      border-left: solid 1px #ccc;
    }

    #custom-search-input .glyphicon-search{
      font-size: 23px;
    }
  </style>
  <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="toolbar-btn-action">
    <a href="<?php $site.$Url[0].'/pedidos';?>" class="btn btn-default">Todos <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?php $site.$Url[0].'/pedidos&status=Aberto'?>" class="btn btn-warning">Abertos <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?php $site.$Url[0].'/pedidos&status=Em Andamento'?>" class="btn btn-info">Em Andamento <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?php $site.$Url[0].'/pedidos&status=Disponível para Retirada'?>" class="btn btn-info">Disponível para Retirada <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?php $site.$Url[0].'/pedidos&status=Saiu para Entrega'?>" class="btn btn-primary">Saiu para Entrega <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?php $site.$Url[0].'/pedidos&status=Finalizado'?>" class="btn btn-success">Finalizados <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?php $site.$Url[0].'/pedidos&status=Cancelado'?>" class="btn btn-danger">Cancelados <i class="fa fa-cutlery" aria-hidden="true"></i></a>
  </div>

  <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="container">
    <div class="row">
      <form action="#search" method="post">
        <div class="col-md-6">           
          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <input type="text" name="s" class="form-control input-lg" placeholder="Código do pedido" />
              <span class="input-group-btn">
                <button class="btn btn-info btn-lg" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br />
  <div id="search"></div>
  <div class="table-responsive">
    <table data-sortable class="table table-hover table-striped">
      <thead>
        <tr>
          <th>Código do pedido</th>              
          <th>Data do pedido</th>              
          <th>DELIVERY</th>              
          <th>Nome</th>
          <th>Telefone</th>
          <th>Envio WhatsApp</th>
          <th>Total</th>
          <th>Status</th>            
          <th data-sortable="false">Ver Pedido</th>
          <th>Motoboy</th>
        </tr>
      </thead>
      <?php
      $inputdadossearch = filter_input_array(INPUT_POST, FILTER_DEFAULT);
      if(!empty($inputdadossearch['s'])):
        $inputdadossearch['s'] = strip_tags(trim($inputdadossearch['s']));
        header("Location: {$site}{$Url[0]}/pedidos&s={$inputdadossearch['s']}");
      endif;    
      ?>
      <tbody>
        <?php
        if(!isset($pesquisar) || empty($pesquisar)):        
          ?>

        <?php
    //INICIO PAGINAÇÃO
        $pagS = (!empty($a) && $a == 'Aberto' || $a == 'Finalizado' || $a == 'Cancelado' || $a == 'Disponível para Retirada' || $a == 'Em Andamento' || $a == 'Saiu para Entrega' ? "&status={$a}" : "");
        $getpage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $pager = new Pager("{$site}{$Url[0]}/pedidos{$pagS}&page=");
        $pager->ExePager($getpage, 15);
    //FIM PAGINAÇÃO
        $qurAberto = "Aberto";
        $qurFinalizado = "Finalizado";
        $qurCancelado = "Cancelado";

        $qurSaiuEntrega = "Saiu para Entrega";
        $qurDisponivelRetirada = "Disponível para Retirada";
        $qurEmAndamento = "Em Andamento";

        $quary   = "";
        $quary2  = "";

        if(!empty($a) && $a == "Aberto"):
          $quary   = "WHERE user_id = :userid AND status = :a";
          $quary2  = "userid={$userlogin['user_id']}&a={$qurAberto}&";
        elseif(!empty($a) && $a == "Finalizado"):
          $quary   = "WHERE user_id = :userid AND status = :f";
          $quary2  = "userid={$userlogin['user_id']}&f={$qurFinalizado}&";
        elseif(!empty($a) && $a == "Cancelado"):
          $quary   = "WHERE user_id = :userid AND status = :c";
          $quary2  = "userid={$userlogin['user_id']}&c={$qurCancelado}&";
        elseif(!empty($a) && $a == "Saiu para Entrega"):
          $quary   = "WHERE user_id = :userid AND status = :t";
          $quary2  = "userid={$userlogin['user_id']}&t={$qurSaiuEntrega}&";
        elseif(!empty($a) && $a == "Disponível para Retirada"):
          $quary   = "WHERE user_id = :userid AND status = :n";
          $quary2  = "userid={$userlogin['user_id']}&n={$qurDisponivelRetirada}&";
        elseif(!empty($a) && $a == "Em Andamento"):
          $quary   = "WHERE user_id = :userid AND status = :zx";
          $quary2  = "userid={$userlogin['user_id']}&zx={$qurEmAndamento}&";
        else:
           $quary   = "WHERE user_id = :userid";
          $quary2  = "userid={$userlogin['user_id']}&";
        endif;

        $lerbanco->ExeRead("ws_pedidos", "{$quary} ORDER BY data DESC LIMIT :limit OFFSET :offset", "{$quary2}limit={$pager->getLimit()}&offset={$pager->getOffset()}");              
        if (!$lerbanco->getResult()):
         $pager->ReturnPage();               
       else:
        foreach ($lerbanco->getResult() as $getItensBanco):
          extract($getItensBanco);                
          ?>
          <!-- INICIO DO LOOP DA LEITURA DO BANCO --> 
          <?php
          if($view == 0):
            echo "<script>
            var sound = new Howl({
              src: ['{$site}campainha.mp3'],
              autoplay: true,
              loop: true,
              });
              sound.play();
              </script>";
            endif;
            ?>
            <tr id="<?php $codigo_pedido;?>" <?php ($view == 0 ? "style='background-color: #34AF23;font-weight: bold;color:#ffffff'" : "");?>>
              <td>
                
                 <strong><?php $codigo_pedido;?></strong>
             
             </td >
             <td>                    
               <?php
               $formatdata = explode(" ", $data);
               $dataformat = explode("-", $formatdata[0]);
               $dataformat = array_reverse($dataformat);
               $dataformat = implode("/", $dataformat);  

               $dataH = explode(":", $formatdata[1]);
               echo '<span>'.$dataformat.' ás '.$dataH[0].':'.$dataH[1].'</span>';
               ?>   
             </td>   
             <td><?php ($opcao_delivery == 'true' ? '<strong style="color:green;">SIM</strong>' : '<strong style="color:#d9534f;">NÃO</strong>');?></td>
             <td>
               <?php
               $nome = str_replace('%20', ' ', $nome);
               $nome = ucfirst($nome);
               echo $nome;
               ?></td>
               <td><?php formatPhone($telefone);?></td>
               <td><?php ($confirm_whatsapp == 'true' ? '<strong style="color:green;">SIM</strong>' : '<strong style="color:#d9534f;">NÃO</strong>');?></td>
               <td>R$ <?php Check::Real($total);?></td>
               <td>                    
                <?php
                if($status == "Aberto"):
                  echo "<span class=\"label label-warning\">Aberto</span>";
                elseif($status == "Finalizado"):
                  echo "<span class=\"label label-success\">Finalizado</span>";
                elseif($status == "Cancelado"):
                  echo "<span class=\"label label-danger\">Cancelado</span>";
                elseif($status == "Em Andamento"):
                  echo "<span class=\"label label-info\">Em Andamento</span>";
                elseif($status == "Saiu para Entrega"):
                  echo "<span class=\"label label-primary\">Saiu para Entrega</span>";
                elseif($status == "Disponível para Retirada"):
                  echo "<span class=\"label label-info\">Disponível para Retirada</span>";
                endif;
                ?>
              </td>
              <td>
                <button id="verPedido_<?php $id;?>" class="btn btn-primary btn-xs">Ver Pedido</button>
                <script type="text/javascript">
                  $(document).ready(function(){

                    $('#verPedido_<?php $id;?>').click(function(){
                      $('#verPedido_<?php $id;?>').html('Aguarde...');
                      $('#verPedido_<?php $id;?>').prop('disabled', true);

                      $.ajax({
                        url: '<?php echo $site; ?>includes/processanotificacao.php',
                        method: "post",
                        data: {'idDoPedido' : '<?php $id;?>', 'iduser' : '<?php $userlogin['user_id'];?>'},

                        success: function(data){        
                          $('#verPedido_<?php $id;?>').html('Ver Pedido');
                          $('#verPedido_<?php $id;?>').prop('disabled', false);
                          if(data == 'true'){
                            window.location.replace('<?php $site.$Url[0].'/ver-pedido&id='.$id;?>');
                          }
                        }
                      });

                    }); 

                  });
                </script>
              </td>  
             
               
              <td>
                  <!--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal">Enviar ao Motoboy</button>-->
                  <button onclick="listMotoboys(<?php $id;?>);" class="btn btn-success btn-xs">Enviar ao Motoboy</button> 
                      
                      <td>
                <button id="verPedido_1<?php $id;?>" class="btn btn-primary btn-xs">Silenciar</button>
                <script type="text/javascript">
                  $(document).ready(function(){

                    $('#verPedido_1<?php $id;?>').click(function(){
                      $('#verPedido_1<?php $id;?>').html('Aguarde...');
                      $('#verPedido_1<?php $id;?>').prop('disabled', true);

                      $.ajax({
                        url: '<?php echo $site; ?>includes/processanotificacao.php',
                        method: "post",
                        data: {'idDoPedido' : '<?php $id;?>', 'iduser' : '<?php $userlogin['user_id'];?>'},

                        success: function(data){        
                          $('#verPedido_1<?php $id;?>').html('silenciar');
                          $('#verPedido_1<?php $id;?>').prop('disabled', false);
                          if(data == 'false'){
                            window.location.replace('<?php $site.$Url[0].'/ver-pedido&id='.$id;?>');
                          }
                        }
                      });

                    }); 

                  });
                </script>
              </td> 
                        <td> 
                    <a href="https://api.whatsapp.com/send?phone=55<?php $telefone;?>&text=🔔 Olá, você acaba de realizar um pedido conosco, pedido confirmado!"><button >Confirmar o Pedido <i class="btn btn-success btn-xs" class="fa fa-arrow-right" aria-hidden="true"></i></button></a>
                     <td> 
                     <button  class="btn_1">Imprimir Pedido <i class="icon-print-2" aria-hidden="true"></i></button></a>
                   
  
   
<div style="display: none;"> 
  <div class="container">
    <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="row justify-content-center ">
      <article class="col-md-4">
        <div id="divImprimir" style="background-color: #fdfbe3;" class="boxed-md boxed-padded">
          <?php

          $dataex = explode(' ', $data);
          $dataex[0] = explode('-', $dataex[0]);
          $dataex[0] = array_reverse($dataex[0]);
          $dataex[0] = implode('/', $dataex[0]);

          $dataformatada =  $dataex[0].' - '.$dataex[1];

          $nome = str_replace('%20', ' ', $nome);
          $nomeCliente = $nome;
          $telefoneformatado = formatPhone($telefone);

          $taxaPedido = Check::Real($valor_taxa);
          $valorTroco = Check::Real($valor_troco);
          $totalPedido = Check::Real($total);

          $resumoPedidosFormatado = str_replace('', '', $resumo_pedidos);
          $resumoPedidosFormatado = str_replace('<b>', '<p>', $resumoPedidosFormatado);
          $resumoPedidosFormatado = str_replace('</b>', '', $resumoPedidosFormatado);

          $telefoneEmpresaFormatado = formatPhone($telefone_empresa);

          echo "<b>".$nome_empresa."</b>";
          echo ".\n <br />";

          echo (!empty($end_rua_n_empresa) && !empty($end_bairro_empresa) && !empty($cidade_empresa) && !empty($end_uf_empresa) ? $end_rua_n_empresa.' <br /> '.$end_bairro_empresa : 'Defina_um_endereço').' - '.$cidade_empresa.' - '.$end_uf_empresa;
          echo "\n <br />";
          echo "Telefone: {$telefoneEmpresaFormatado}";


          echo "\n <br />";
          echo "\n <br />";

          echo "<b>PEDIDO: #{$codigo_pedido}</b>\n <br />";    
          echo "{$dataformatada} <br />";  
          echo "\n <br />";
          echo "-----------------------------"."\n  <br />";      
          if($opcao_delivery != 'true'):
            echo "{$msg_delivery_false}\n  <br />";
            echo "Observações: {$name_observacao_mesa}\n  <br />";
          else:
            echo "Rua: {$rua}, Nº {$unidade}\n  <br />";
            echo "Bairro: {$bairro}\n  <br />";
            echo "Cidade: {$cidade} - {$uf}\n  <br />";
            echo "Complemento: {$complemento}\n  <br />";
            echo "Observação: {$observacao}\n  <br />";
          endif;
          echo "-----------------------------"."\n  <br />"; 
          echo "\n <br />";  


          echo "DADOS DO CLIENTE: <br />";

          echo "NOME: {$nomeCliente}\n  <br />";
          echo "TEL: {$telefoneformatado}\n  <br />";  

          echo "-----------------------------"."\n  <br />"; 
          echo "\n <br />"; 

          echo "RESUMO DO PEDIDO: <br />";
          echo "{$resumoPedidosFormatado}";
          
          echo "-----------------------------"."\n  <br />";  

          echo "PAGAMENTO: {$forma_pagamento}\n  <br />";
          echo (!empty($sub_total) || $sub_total != '0.00' ? "SUBTOTAL: R$ ".Check::Real($sub_total)." \n <br />" : "" );
          if(!empty($desconto) && $desconto != 0):
            echo "DESCONTO: {$desconto}% \n <br />";
          endif;
          if($valor_taxa != '0.00'):
            echo "DELIVERY: R$ {$taxaPedido}\n  <br />";
          endif;                    
          echo "TOTAL: R$ {$totalPedido} \n <br />";
          if(!empty($valor_troco) && $valor_troco != '0.00'):
            echo "TROCO PARA: R$ {$valorTroco}\n  <br />";
          endif;
          echo "-----------------------------"." \n <br />";
          
          echo "\n <br />";

          echo "***OBRIGADO E BOM APETITE*** \n <br />";
          ?>
        </div>
      </article>
    </div>
  </div>
</div>
 
    
              </td>
            </tr>   
            <?php
          endforeach;
          $corD = '000000';
          if(!empty($a) && $a == "Aberto"):
            $corD = 'f0ad4e';
          elseif(!empty($a) && $a == "Finalizado"):
           $corD = '5cb85c';
         elseif(!empty($a) && $a == "Cancelado"):
           $corD = 'd10303';
         else:
    //NÃO FAZ NADA
         endif;
         echo "<strong style=\"color: #000000\">Total de Pedidos: ".$lerbanco->getRowCount()."</span><hr />";
       endif;
       ?>  
       
       <!-- FINAL DO LOOP DA LEITURA DO BANCO -->

       <?php
     else:
      $lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :userid AND codigo_pedido = :v", "userid={$userlogin['user_id']}&v={$pesquisar}");
      if (!$lerbanco->getResult()):
        echo "<tr>
        <div class=\"alert alert-info alert-dismissable\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
        <b class=\"alert-link\">PEDIDO NÃO ENCONTRADO!</b>
        </div>
        </tr>";
      else:
        foreach($lerbanco->getResult() as $getItensBanco):
          extract($getItensBanco);
        endforeach;
        ?>

        <tr>
          <td>
            
             <strong><?php $codigo_pedido;?></strong>
           
         </td>
         <td>                    
           <?php
           $formatdata = explode(" ", $data);
           $dataformat = explode("-", $formatdata[0]);
           $dataformat = array_reverse($dataformat);
           $dataformat = implode("/", $dataformat);       

           $dataH = explode(":", $formatdata[1]);
           echo '<span>'.$dataformat.' ás '.$dataH[0].':'.$dataH[1].'</span>';
           ?>   
         </td>   
         <td><?php ($opcao_delivery == 'true' ? 'Sim' : 'Não');?></td>
         <td><?php echo str_replace('%20', ' ', $nome);?></td>
         <td><?php formatPhone($telefone);?></td>
         <td>R$ <?php Check::Real($total);?></td>
         <td>                    
          <?php
          if($status == "Aberto"):
            echo "<span class=\"label label-warning\">Aberto</span>";
          elseif($status == "Finalizado"):
            echo "<span class=\"label label-success\">Finalizado</span>";
          elseif($status == "Cancelado"):
            echo "<span class=\"label label-danger\">Cancelado</span>";
          elseif($status == "Em Andamento"):
            echo "<span class=\"label label-info\">Em Andamento</span>";
          elseif($status == "Saiu para Entrega"):
            echo "<span class=\"label label-primary\">Saiu para Entrega</span>";
          elseif($status == "Disponível para Retirada"):
            echo "<span class=\"label label-info\">Disponível para Retirada</span>";
          endif;
          ?>
        </td>
        <td><button id="verPedido_<?php $id;?>" class="btn btn-primary btn-xs">Ver Pedido</button>
           <script type="text/javascript">
                  $(document).ready(function(){

                    $('#verPedido_<?php $id;?>').click(function(){
                      $('#verPedido_<?php $id;?>').html('Aguarde...');
                      $('#verPedido_<?php $id;?>').prop('disabled', true);

                      $.ajax({
                        url: '<?php echo $site; ?>includes/processanotificacao.php',
                        method: "post",
                        data: {'idDoPedido' : '<?php $id;?>', 'iduser' : '<?php $userlogin['user_id'];?>'},

                        success: function(data){        
                          $('#verPedido_<?php $id;?>').html('Ver Pedido');
                          $('#verPedido_<?php $id;?>').prop('disabled', false);
                          if(data == 'true'){
                            window.location.replace('<?php $site.$Url[0].'/ver-pedido&id='.$id;?>');
                          }
                        }
                      });

                    }); 

                  });
                </script>
                
                 </td>
        <td><button id="verPedido_1<?php $id;?>" class="btn btn-primary btn-xs">Ver Pedido</button>
           <script type="text/javascript">
                  $(document).ready(function(){

                    $('#verPedido_1<?php $id;?>').click(function(){
                      $('#verPedido_1<?php $id;?>').html('Aguarde...');
                      $('#verPedido_1<?php $id;?>').prop('disabled', true);

                      $.ajax({
                        url: '<?php echo $site; ?>includes/processanotificacao.php',
                        method: "post",
                        data: {'idDoPedido' : '<?php $id;?>', 'iduser' : '<?php $userlogin['user_id'];?>'},

                        success: function(data){        
                          $('#verPedido_1<?php $id;?>').html('Ver Pedido');
                          $('#verPedido_1<?php $id;?>').prop('disabled', false);
                          if(data == 'true'){
                            window.location.replace('<?php $site.$Url[0].'/ver-pedido&id='.$id;?>');
                          }
                        }
                      });

                    }); 

                  });
                </script>
        </td>   
      </tr>
      <?php
    endif;
  endif;
  ?>  
</tbody>
</table>
</div>

<div class="data-table-toolbar">
 <?php
 if(!isset($pesquisar) || empty($pesquisar)):
      //INICIO PAGINAÇÃO
   $pager->ExePaginator("ws_pedidos" ,"{$quary}", "{$quary2}");
 echo $pager->getPaginator();
      //FIM PAGINAÇÃO
endif;
?>  
</div>

</div>

<br />
<div class="alert alert-info container margin_60">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon-attach-3"></i> NOTAS!</h4>
  <p>
   <strong>Clique em "Ver Pedido" Para ver ou editar o status do pedido!  <br /> 
   <strong>Pedidos com a cor de fundo  <b style="color:#34AF23;">VERDE</b> Significa que não foram visualizados!

   </p>

 </div>
 <div id="chamadanotificacao"></div>
 
 <!-- The Modal -->
  <span id="modal_listMotoboys_open" data-toggle="modal" data-target="#modal_listMotoboys"></span>
  <div class="modal" style="margin-top: 80px;" id="modal_listMotoboys">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Motoboys</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <span>Envie o pedido diretamente no whatsapp do motoboy.</span></br></br>
            <!-- Function Modal -->
            <script>
                
            </script>
            <div id="content_listMotoboys">
                <table id="table_listMotoboys" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome do Entregador</th>
                            <th>Número de Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="table_tbody_listMotoboys">
                        <tr>
                            <td>1</td>
                            <td>Ronaldo Vasquez</td>
                            <td>(15) 12345-6789</td>
                            <td>
                                <button class="btn btn-primary btn-xs">Enviar Pedido</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>listMotoboys();</script>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
        
      </div>
    </div>
  </div>
  
<script>
    function listMotoboys(id_ped) {
        <? $lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :userid", "userid={$userlogin['user_id']}"); ?>
        var listPedidos = <?php json_encode($lerbanco->getResult());?>;
        
        <? $lerbanco->ExeRead('ws_motoboys', "WHERE user_id = :userid", "userid={$userlogin['user_id']}"); ?>
        var data = <?php json_encode($lerbanco->getResult());?>;
        
        var exists = false;
        if (listPedidos.length > 0) {
            for (i = 0; i < listPedidos.length; i++) {
                if (listPedidos[i]['id'] == id_ped) {
                    exists = i;
                    break;
                }
            }
        }
        
        if (exists === false) {
            alert("Pedido inválido no sistema");
            return;
        }
        
        var str = "";
        for (i = 0; i < data.length; i++) {
            var name = data[i]['deliveryman_name'];
            var phone_number = data[i]['deliveryman_phone_number'];
            var phone_number_nopont = phone_number.replace("(","");
            var phone_number_nopont = phone_number_nopont.replace(")","");
            var phone_number_nopont = phone_number_nopont.replace(" ","");
            var phone_number_nopont = phone_number_nopont.replace("-","");
            var text = "Pedido: "+listPedidos[exists]['codigo_pedido']+"%0ANome do Cliente: "+listPedidos[exists]['nome']+"%0ATelefone: "+listPedidos[exists]['telefone']+"%0AEndereço: "+listPedidos[exists]['rua']+", nº "+listPedidos[exists]['unidade']+"%0A"+listPedidos[exists]['bairro']+"%0A"+listPedidos[exists]['cidade']+"-"+listPedidos[exists]['uf']+"%0A%0AForma de Pagamento: "+listPedidos[exists]['forma_pagamento']+"%0AValor Total: "+listPedidos[exists]['total']+"%0ATroco: "+listPedidos[exists]['valor_troco'];
            var str = str+"<tr><td>"+(i+1)+"</td><td>"+name+"</td><td>"+phone_number+"</td><td><a target=\"_blank\" href=\"https://api.whatsapp.com/send?phone=55"+phone_number_nopont+"&text="+text+"\"><button class=\"btn btn-primary btn-xs\">Enviar Pedido</button></a></td></tr>";
        }
        $("#table_tbody_listMotoboys").html(str);
        $("#modal_listMotoboys_open").click();
    }
</script>

 <script> type="text/javascript">
  setTimeout(function() {
    window.location.reload(1);
  }, 60000);
  
  $(document).ready(function () {
    $("tr").dblclick(function(){
        
    });
  });
</script>

 <script type="text/javascript">
 $(".btn_1").on('click', function() {
	$(this).closest("tr").children("td").find("#divImprimir").printThis({
      doctypeString: '<meta charset="utf-8">', 
      importStyle: true,
      base: false,
    });
});
</script>

