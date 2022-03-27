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
?>

<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">   		 
		<div class="row"> 
			<div class="col-md-8 col-md-offset-2">  				
				<div id="sendnewpass" class="indent_title_in">

					<h3><strong>Alterar plano</strong> </h3>
					<p>
						<a class="btn btn-primary" href="https://www.youtube.com/channel/UCUVhSNdrLyQ64i123Uc8btg/videos>" target="_blank"></i><span class="float-right text-center font-w-700"><strong>TUTORIAL</strong></a>
					</p>
					<br />
					<?php
					$getformapagamento = filter_input_array(INPUT_POST, FILTER_DEFAULT);

					if(!empty($getformapagamento)):
						$getformapagamento = array_map('strip_tags', $getformapagamento);
						$getformapagamento = array_map('trim', $getformapagamento);

						if(in_array('', $getformapagamento)):
							echo "<script>
							x0p('Opss...', 
							'Preencha o campo abaixo!',
							'error', false);
							</script>";
						else:

							$updatebanco->ExeUpdate("ws_users", $getformapagamento, "WHERE user_id = :up", "up={$userlogin['user_id']}");
							if ($updatebanco->getResult()):
								echo "<script>x0p('Sucesso!', 
								'O seu plano foi atualizado. saindo...', 
								'ok', false);</script>";
								header("Refresh: 5; url={$site}{$Url[0]}/admin-loja&logoff=true");
							else:
								echo "<script>
								x0p('Opss...', 
								'Ocorreu um Erro!',
								'error', false);
								</script>";
								header("Refresh: 5; url={$site}{$Url[0]}/alterar-plano");
							endif;

							

						endif;

					endif;
					?>
					<form method="post">
						<div class="form-group">
							<label for="nome_empresa">MEU PLANO</label>
							<select name="user_plano" class="form-control" >
								<option <?php (!empty($userlogin['user_plano']) && $userlogin['user_plano'] == 1 ? "selected" : "");?> value="1"><?php $texto['nomePlanoUm']." = R$ ".$texto['valorPlanoUm'].",00";?></option>
								<option <?php (!empty($userlogin['user_plano']) && $userlogin['user_plano'] == 2 ? "selected" : "");?> value="2"><?php $texto['nomePlanoDois']." = R$ ".$texto['valorPlanoDois'].",00";?></option>
								<option <?php (!empty($userlogin['user_plano']) && $userlogin['user_plano'] == 3 ? "selected" : "");?> value="3"><?php $texto['nomePlanoTres']." = R$ ".$texto['valorPlanoTres'].",00";?></option>
							</select>
						</div>	
						<?php
						$nplano = "";
						if($userlogin['user_plano'] == 1):
							$nplano = $texto['nomePlanoUm'];
						elseif($userlogin['user_plano'] == 2):
							$nplano =	$texto['nomePlanoDois'];
						else:
							$nplano =	$texto['nomePlanoTres'];
						endif;
						?>
						
						<div class="form-group">	
													<a mp-mode="dftl" href="https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380847c02d799017c1a521cf918df" name="MP-payButton" class='btn btn-success'>Débito Automático</a>
<script type="text/javascript">
   (function() {
      function $MPC_load() {
         window.$MPC_loaded !== true && (function() {
         var s = document.createElement("script");
         s.type = "text/javascript";
         s.async = true;
         s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
         var x = document.getElementsByTagName('script')[0];
         x.parentNode.insertBefore(s, x);
         window.$MPC_loaded = true;
      })();
   }
   window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
   })();
</script>
<a class="gradient-bg-1" href="https://api.whatsapp.com/send?phone=55<?php PHONE_NUMBER;?>&text=Olá!%A0Gostaria de Fazer o Pagamento Via PIX, Chave Pix: +5547996992911" target="_blank"></i><span class="btn btn-success">Pagamento PIX</a>
							</a>
							<a class="gradient-bg-1" href="https://api.whatsapp.com/send?phone=55<?php PHONE_NUMBER;?>&text=Olá!%A0Gostaria de Fazer o Pagamento Por Boleto" target="_blank"></i><span class="btn btn-success">Boleto Bancario</a>
							</a>
							<a class="gradient-bg-1" href="https://api.whatsapp.com/send?phone=55<?php PHONE_NUMBER;?>&text=Olá!%A0Gostaria de Alterar meu plano." target="_blank"></i><span class="btn btn-danger">Alterar meu Plano</a>
							</a>

						</div>
					</form>
					<img src="<?php echo $site; ?>img/bandeiras-mercado-pago.png" style="max-width: 400px;height: auto;" />
					<br />				
					<br />
					<p style="color: red;"><br />
					<strong>*ATENÇÃO*</strong>
					TODOS OS PAGAMENTOS SÃO PROCESSADOS PELO MERCADO PAGO TOTALMENTE SEGURO E DENTRO DA LEI.</p>
					<br />

				</div>
			</div><!-- End col  -->
		</div><!-- End row  -->
	</div>

</div><!-- End container  -->