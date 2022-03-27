<link href="css/color_scheme.css" rel="stylesheet">

<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<?php require('../_app/Config.inc.php');
require('../_app/Helpers/Check.class.php');

$site = HOME;
$bairrosstatus = 'false';
$pedidos = '';

if(isset($cart) && !empty($cart)) {
	$allItems = $cart->getItems();
}

/*
if (!isset($_POST['opcao_delivery']) || $cart->isEmpty() && (isset($site) && !empty($site)) && (isset($Url) && !empty($Url))) {
	header("Location: {$site}{$Url[0]}");
}
*/

if(isset($allItems) && !empty($allItems)) {
	foreach ($allItems as $items) {
		foreach ($items as $item) {
			if (!empty($item['attributes']['totalAdicionais'])) {
				$todosOsAdicionais = '';
				$todosOsAdicionaisSoma = 0;
	
				for ($i = 0; $i < $item['attributes']['totalAdicionais']; $i++) {
					$todosOsAdicionais = $todosOsAdicionais . $item['attributes']['adicional_nome' . $i] . ', ';
					$todosOsAdicionaisSoma = ($todosOsAdicionaisSoma + $item['attributes']['adicional_valor' . $i]);
				}
			}
	
			$pedidos = $pedidos . '<b>' . $texto['msg_qtd'] . '</b> '
			. $item['quantity'] . 'x '
			. $item['attributes']['nome']
			. (!empty($item['attributes']['adicionais_gratis']) ? '<br /><b>Adicionais grátis:</b><br />' . $item['attributes']['adicionais_gratis'] : '')
			. (!empty($item['attributes']['totalAdicionais']) ? '<br /><b>Adicionais pagos:</b><br />' . $todosOsAdicionais : '')
			. '<br />'
			. (!empty($item['attributes']['opcao_unica']) ? '<b>Opção: </b>' . $item['attributes']['opcao_unica'] . '<br />' : '')
			. '<b>' . $texto['msg_valor'] . '</b> R$ ' . Check::Real(($item['attributes']['preco'] * $item['quantity']) + (!empty($item['attributes']['totalAdicionais']) ? ($todosOsAdicionaisSoma * $item['quantity']) : 0))
			. '<br /><b>OBS:</b> ' . $item['attributes']['observacao']
			. '<br /><br />';
		}
	}
}

function tirarAcentos($string) {
	$formato = array();
	$formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
	$formato['b'] = 'AAAAAAAcEEEEIIIIDNOOOOOOUUUUuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	$string = strtr(utf8_decode($string), utf8_decode($formato['a']), $formato['b']);
	return utf8_encode($string);
}

if(isset($lerbanco) && !empty($lerbanco) && isset($getu) && !empty($getu)) {
	$delivery_distance_type = 'district';
	$delivery_distance_table = 'bairros_delivery';
	$lerbanco->ExeRead('delivery_distance_config', 'WHERE user_id = :user_id', "user_id={$getu}");
	
	if ($lerbanco->getResult()) {
		$delivery_distance_config_result = $lerbanco->getResult();
		$delivery_distance_type = $delivery_distance_config_result[0]['type'];
	
		if ($delivery_distance_type == 'delivery_rate') {
			$delivery_distance_table = 'delivery_distance_rate';
		}
	} 
} ?>

<div class="row">
	<div class="box_style_2 info">
		<div>
			<br />
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<strong>FALTA POUCO PARA CONCLUIR SEU PEDIDO!</strong>
			<h4 class="nomargin_top">
				<?php $texto['msg_delivery_time']; ?><i class="icon_clock_alt pull-right"></i>
			</h4>
			<p>
				<?php (!empty($msg_tempo_delivery) ? $msg_tempo_delivery : ""); ?>
				<?php (!empty($minimo_delivery) && $minimo_delivery != '0.00' ? "<br /><b style='color:red;'>Valor mínimo:</b> R$ " . Check::Real($minimo_delivery) : ''); ?>
			</p>
			<hr />
			<h4 class="nomargin_top">Retirada no Balcão <i class="icon_clock_alt pull-right"></i></h4>
			<p>
				<?php (!empty($msg_tempo_buscar) ? $msg_tempo_buscar : ""); ?>
			</p>
		</div>
		<div class="box_style_2 hidden-xs" id="help">
			<i class="icon_lifesaver"></i>
			<h4>
				<?php $texto['home_ajuda']; ?>
			</h4>
			<a href="https://api.whatsapp.com/send?1=pt_BR&phone=<?php (!empty($telefone_empresa) ? '55' . $telefone_empresa : ''); ?>" target="_blank" class="phone" style="color: #000000">
				<?php (!empty($telefone_empresa) ? formatPhone($telefone_empresa) : '(00) 00000-0000'); ?>
			</a>
		</div>
	</div>
	<form id="getDadosPedidoCompleto" method="post">
		<div class="row">
			<div class="col-md-6">
				<?php if(isset($_POST['opcao_delivery'])) { ?>
					<div class="mg-b-10">
						<?php if ($_POST['opcao_delivery'] == 'true') : ?>
							<img src="<?php $site; ?>img/delivery.jpg" style="max-width: 100%;height: auto;" />
						<?php elseif ($_POST['opcao_delivery'] == 'false') : ?>
							<img src="<?php $site; ?>img/bcartao.jpg" style="max-width: 100%;height: auto;" />
						<?php elseif ($_POST['opcao_delivery'] == 'false2') : ?>
							<img src="<?php $site; ?>img/mesa.jpg" style="max-width: 100%;height: auto;" />
						<?php endif; ?>
					</div>
				<?php } ?>
				<div class="box_style_2" id="order_process">
					<div style="text-transform: uppercase;font-weight: 700;font-size: 13px;color: #343a40;letter-spacing: 1px;">
						<i class="fa fa-caret-right"></i> <?php $texto['msg_msg_dadosabaixo']; ?>
					</div>
					<br />
					<div class="form-group">
						<label for="telefone"><span style="color: red;">* </span><?php $texto['msg_seu_tell']; ?></label>
						<input required type="tel" id="telefone" name="telefone" class="form-control" placeholder="(99) 99999-9999" data-mask="(00) 00000-0000" maxlength="15" value="<?php echo $_POST['telefone'] ?? ''; ?>">
					</div>
					<div class="form-group">
						<label for="nome"><span style="color: red;">* </span><?php $texto['msg_seu_nome']; ?></label>
						<input required type="text" class="form-control" id="nome" name="nome" placeholder="<?php $texto['msg_seu_nome']; ?>" value="<?php echo $_POST['nome'] ?? ''; ?>">
					</div>
					<?php if(isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'false2') { ?>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label"><span style="color: red;">*</span>
										<?php $texto['msg_msg_Nmesa']; ?></label>
									<input type="number" name="mesa" id="mesa" class="form-control numero" maxlength="2" required value="<?php echo $_POST['mesa'] ?? ''; ?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label"><span style="color: red;">*</span>
										<?php $texto['msg_msg_qtdpessoas']; ?></label>
									<input type="number" name="pessoas" id="pessoas" class="form-control numero" maxlength="2" required value="<?php echo $_POST['pessoas'] ?? ''; ?>">
								</div>
							</div>
						</div>
					<?php } ?>

					<!-- é necessário entregar -->
					<?php if(isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'true') { ?>
						<?php if ($delivery_distance_type == 'district') {
							$lerbanco->ExeRead($delivery_distance_table, 'WHERE user_id = :user_id', "user_id={$getu}");
							if ($lerbanco->getResult()) {
								$bairrosstatus = 'true'; ?>
								<!-- INICIO DO LOOP DOS BAIRROS -->
								<input type="hidden" required name="bairro2" id="bairro2" value="<?php echo $_POST['bairro2'] ?? ''; ?>">
								<div class="form-group">
									<label for="bairro"><span style="color: red;">
											* </span><?php $texto['msg_seu_bairro']; ?>
									</label>
									<select name="bairro" id="framework" class="form-control js-example-basic-single getBairro" required data-live-search="true">
										<option value="">
											<?php $texto['msg_sel_bairro']; ?>
										</option>
										<?php $lerbanco->ExeRead($delivery_distance_table, 'WHERE user_id = :user_id', "user_id={$getu}");

										if ($lerbanco->getResult()) {
											foreach ($lerbanco->getResult() as $getBancoBairros) :
												extract($getBancoBairros); ?>
												<option value="<?php $id; ?>"><?php $bairro . ' (R$ ' . Check::real($taxa) . ')'; ?></option>
										<?php endforeach;
										} ?>
									</select>
								</div>
								<!-- FINAL DO LOOP DOS BAIRROS -->
							<?php } else { ?>
								<div class="form-group">
									<label for="bairro"><span style="color: red;">* </span><?php $texto['msg_seu_b']; ?></label>
									<?php if(isset($_POST['bairro'])) { ?>
										<input type="text" required size="150" id="bairro" name="bairro" class="form-control" placeholder="" value="<?php echo $_POST['bairro'] ?? ''; ?>">
									<?php } ?>
								</div>
						<?php }
						}
					}

					// calcular distancia para entrega
					if (isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'true' && isset($delivery_distance_type) && $delivery_distance_type == 'distance_rate') { ?>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="cidade">
										<span style="color: red;">* </span><?php $texto['msg_sua_cidade']; ?>
									</label>
									<input type="text" onfocusout="deliveryRateCalculate()" value="<?php ($bairrosstatus == 'false' ? $cidade_empresa : ''); ?>" required id="cidade" name="cidade" size="40" class="form-control" placeholder="" value="<?php echo $_POST['cidade'] ?? ''; ?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="uf"><span style="color: red;">* </span><?php $texto['msg_seu_estado']; ?>
									</label>
									<input type="text" onfocusout="deliveryRateCalculate()" value="<?php ($bairrosstatus == 'false' ? $end_uf_empresa : ''); ?>" required id="uf" name="uf" size="2" class="form-control" placeholder="" value="<?php echo $_POST['uf'] ?? ''; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="bairro"><span style="color: red;">* </span><?php $texto['msg_seu_b']; ?></label>
								<input type="text" required size="150" id="bairro" name="bairro" class="form-control" placeholder="" value="<?php echo $_POST['bairro'] ?? ''; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="rua"><span style="color: red;">* </span><?php $texto['msg_sua_rua']; ?></label>
									<input type="text" required onfocusout="deliveryRateCalculate()" autocomplete="off" id="rua" name="rua" size="60" class="form-control" placeholder="" value="<?php echo $_POST['rua'] ?? ''; ?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="unidade"><span style="color: red;">*
										</span><?php $texto['msg_seu_n']; ?></label>
									<input type="tel" required onfocusout="deliveryRateCalculate()" autocomplete="off" id="xx55" data-mask="#########0" name="unidade" size="60" class="form-control" placeholder="" value="<?php echo $_POST['unidade'] ?? ''; ?>">
								</div>
							</div>
						</div>
					<?php } 
					else { ?>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="cidade">
										<span style="color: red;">
										* </span>
										<?php $texto['msg_sua_cidade']; ?>
									</label>
									<?php if(isset($bairrosstatus) && !empty($bairrosstatus) && isset($cidade_empresa) && !empty($cidade_empresa) && isset($_POST['cidade'])) { ?>
										<input type="text" value="<?php ($bairrosstatus == 'false' ? $cidade_empresa : ''); ?>" required id="cidade" name="cidade" size="40" class="form-control" placeholder="" value="<?php echo $_POST['cidade'] ?? ''; ?>">
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="uf">
										<span style="color: red;">
										* </span>
										<?php $texto['msg_seu_estado']; ?>
									</label>
									<?php if(isset($bairrosstatus) && !empty($bairrosstatus) && isset($end_uf_empresa) && !empty($end_uf_empresa) && isset($_POST['uf'])) { ?>
										<input type="text" value="<?php ($bairrosstatus == 'false' ? $end_uf_empresa : ''); ?>" required id="uf" name="uf" size="2" class="form-control" placeholder="" value="<?php echo $_POST['uf'] ?? ''; ?>">
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="rua">
										<span style="color: red;">* </span><?php $texto['msg_sua_rua']; ?>
									</label>
									<?php if(isset($_POST['rua'])) { ?>
										<input type="text" required id="rua" name="rua" size="60" class="form-control" placeholder="" value="<?php echo $_POST['rua'] ?? ''; ?>">
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="unidade">
										<span style="color: red;">*</span>
										<?php $texto['msg_seu_n']; ?>
									</label>
									<?php if(isset($_POST['unidade'])) { ?>
										<input type="tel" required id="unidade" data-mask="#########0" name="unidade" size="60" class="form-control" placeholder="" value="<?php echo $_POST['unidade'] ?? ''; ?>">
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<div class="form-group">
						<div class="form-group">
							<label for="observacao">
								<?php $texto['msg_obs_endereco']; ?> (Opcional)
							</label>
							<?php if(isset($_POST['observacao'])) { ?>
								<input type="text" id="observacao" name="observacao" id="observacao" class="form-control" placeholder="<?php $texto['msg_placehold_obs']; ?>" value="<?php echo $_POST['observacao'] ?? ''; ?>">
							<?php } ?>
						</div>
						<hr>
					</div>
					<!-- é necessário entregar -->
					<div class="row">
						<?php if(isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] != 'false2') { ?>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="forma_pagamento">
										<span style="color: red;">* </span>
										<?php $texto['msg_f_pagamento']; ?>
									</label>
									<select class="form-control" required name="forma_pagamento" id="forma_pagamento">
										<option>Selecione...</option>
										<?php if(isset($lerbanco) && !empty($lerbanco) && isset($getu) && !empty($$getu)) {
										$lerbanco->ExeRead('ws_formas_pagamento', 'WHERE user_id = :idus', "idus={$getu}");
										
										if ($lerbanco->getResult()) {
											foreach ($lerbanco->getResult() as $getBancoBairros) {
												extract($getBancoBairros);
												if ($f_pagamento) {
													/* if($type_pay == 2) {
															$find = "DINHEIRO";
															$string = strtoupper($f_pagamento);
															$stringExists = strpos($string, $find);
	
															if($stringExists === false) { // string não encontrada ?> 
																<option value="<?php $f_pagamento;?>">
																	<?php $f_pagamento;?>
																</option> 
															<?php }
														}
														else { */ ?>
													<option value="<?php $f_pagamento; ?>">
														<?php $f_pagamento; ?>
													</option>
										<?php // }
												}
											}
										} 
									} ?>
									</select>
								</div>
							</div>
						<?php } ?>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="valor_troco">
									<span style="color: red;">* </span><?php $texto['msg_troco']; ?>
								</label>
								<?php if(isset($_POST['valor_troco'])) { ?>
									<input required type="tel" maxlength="11" data-mask="#.##0,00" data-mask-reverse="true" name="valor_troco" id="valor_troco" class="form-control" placeholder="0,00" value="0,00" value="<?php echo $_POST['valor_troco'] ?? ''; ?>" />
								<?php } ?>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-control-label">
									<?php $texto['msg_msg_obsmesa']; ?>
								</label>
								<textarea rows="3" class="form-control" name="name_observacao_mesa" id="name_observacao_mesa" maxlength="60">Nenhuma</textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="icheck-material-grey">
									<?php if(isset($btn_whats) && !empty($btn_whats) && isset($_POST['confirm_whatsapp'])) { ?>
										<input <?php ($btn_whats == 0 ? 'checked' : ''); ?> type="checkbox" name="confirm_whatsapp" value="true" id="green" value="<?php echo $_POST['confirm_whatsapp'] ?? ''; ?>" />
									<?php } ?>
									<label for="">
										<strong><?php $texto['msg_msg_enviarzap']; ?></strong>
									</label>
								</div>
							</div>
						</div>
						<?php if(isset($bairrosstatus) && !empty($bairrosstatus) && isset($config_delivery) && !empty($config_delivery) && isset($_POST['opcao_delivery'])) { ?>
							<input type="hidden" required name="valor_taxa" id="valor_taxa" value="<?php ($bairrosstatus == 'false' && $_POST['opcao_delivery'] == 'true' ? $config_delivery : '0.00'); ?>">
						<?php } ?>
					</div>
					<hr />
					<div class="row">
						<span style="color: red;">
							<b>ATENÇÃO:</b>
							<br />
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
							Nunca passe seus dados do
							cartão pelo
							<strong>WHATSAPP!</strong>
							<br />
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
							Todo o Processo é Feito De
							Forma Segura e Registrado Dentro Da Lei.
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-3" id="sidebar">
				<div class="theiaStickySidebar">
					<div id="cart_box">
						<h3>
							<?php $texto['msg_resumo_pedido']; ?>
							<i class="icon_cart_alt pull-right"></i>
						</h3>
						<?php if(isset($cart) && !empty($cart) && $cart->isEmpty()) {
							if (file_exists("img/imgfome.png") && !is_dir("img/imgfome.png")) {
								echo "<div id=\"div-img-fome\"><figure><img id=\"img-fome\" src=\"img/imgfome.png\" title=\"img-fome\" alt=\"img-fome\" /></figure></div><hr />";
							}
						} 
						else { ?>
							<table class="table table_summary">
								<tbody>
									<?php echo $pedidos; ?>
								</tbody>
							</table>
							<hr>
						<?php } ?>
						<?php if(isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'true') {
							echo "<input type=\"hidden\" name=\"opcao_delivery\" id=\"opcao_delivery\" value=\"true\" />";
						} 
						else {
							echo "<input type=\"hidden\" name=\"opcao_delivery\" id=\"opcao_delivery\" value=\"false\" />";
						} ?>
						<table class="table table_summary">
							<tbody>
								<?php if(isset($cart) && !empty($cart)) { ?>
									<tr>
										<td>
											<?php $texto['msg_subtotal']; ?>
											<span class="pull-right">R$
											<?php (!empty($cart->getAttributeTotal('preco')) ? Check::Real($cart->getAttributeTotal('preco')) : '0,00'); ?></span>
										</td>
									</tr>
								<?php } ?>
								<tr>
									<td>
										<?php $texto['msg_adicionais']; ?>
										<span class="pull-right">
											R$
											<?php if(isset($allItems) && !empty($allItems)) {
											$allItems = $cart->getItems();
											$totaldeadicionais = 0;

											foreach ($allItems as $items) :
												foreach ($items as $item) :
													$todosOsAdicionaisSoma2 = 0;
													if (!empty($item['attributes']['totalAdicionais'])) :
														for ($i = 0; $i < $item['attributes']['totalAdicionais']; $i++) :
															$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 + $item['attributes']['adicional_valor' . $i]);
														endfor;
														$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 * $item['quantity']);
													endif;
													$totaldeadicionais = $totaldeadicionais + $todosOsAdicionaisSoma2;
												endforeach;
											endforeach;
											echo Check::Real($totaldeadicionais);
											$total_do_pedido = $cart->getAttributeTotal('preco') + $totaldeadicionais;
											$total_g = ($bairrosstatus == 'false' && $_POST['opcao_delivery'] == 'true' ? $total_do_pedido + $config_delivery : $total_do_pedido);
											$porcentagem = 0;
											$fixed_value = 0.00;
											if (!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu) :
												if ($_SESSION['desconto_cupom']['type_discount'] == 1) {
													$porcentagem = Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $total_g);
												} elseif ($_SESSION['desconto_cupom']['type_discount'] == 2) {
													$fixed_value = $_SESSION['desconto_cupom']['desconto'];
												}
											endif;
											//$total_g = $_SESSION['desconto_cupom']['type_discount'] == 1 ? $total_g - $porcentagem : $total_g - $fixed_value;	
											$total_g = isset($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['type_discount'] == 1 ? $total_g - $porcentagem : $total_g - $fixed_value;	
										} ?>
										</span>
									</td>
								</tr>
								<?php if(isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'true') : ?>
									<tr>
										<td>
											Delivery <span id="taxaDelivery" style="color: red;" class="pull-right"><?php ($bairrosstatus == 'false' ? $config_delivery : '0.00'); ?></span>
										</td>
									</tr>
								<?php endif; ?>
								<tr>
									<?php if (!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu) : ?>
										<td>
											<a style="color: green;">
												Desconto
												<span class="pull-right">
													<?php $_SESSION['desconto_cupom']['desconto']; ?>
													<?php ($_SESSION['desconto_cupom']['type_discount'] == 1 ? $_SESSION['desconto_cupom']['desconto'] . " %" : "R$ " . str_replace('.', ',', $_SESSION['desconto_cupom']['desconto'])); ?>
												</span>
											</a>
										</td>
									<?php endif; ?>
								</tr>
								<tr>
									<td class="total">
										<?php $texto['msg_total_valor']; ?>
										<span class="pull-right" id="v-total-p"><?php $total_g; ?>
										</span>
										<script type="text/javascript">
											var totalSemFormatacao = <?php $total_g; ?>;
											var pegaTaxa = $('#taxaDelivery').text();
										</script>
									</td>
								</tr>
							</tbody>
						</table>
						<hr>
						<!-- verificar se precisa salvar o value aqui -->
						<input type="hidden" name="enviar_pedido" value="enviar_agora" value="<?php echo $_POST['enviar_pedido'] ?? ''; ?>" />
						<input type="hidden" name="user_id" value="<?php $getu; ?>" value="<?php echo $_POST['user_id'] ?? ''; ?>" />
						<input type="hidden" id="sub_total" name="sub_total" value="<?php $total_do_pedido; ?>" value="<?php echo $_POST['sub_total'] ?? ''; ?>" />
						<?php if ($type_pay == 0) { ?>
							<button id="btn_pay_ps" type="button" class="pagseguro-button" onclick="x0p('', 'Opss... Preencha todos os campos!', 'error', false);">
								PAGAR (PAGSEGURO)
							</button>
							<div id="div_script_btn">
								<!--<script id="script_btn"></script>-->
								<button id="btn_pay_mp" type="button" class="mercadopago-button" onclick="x0p('', 'Opss... Preencha todos os campos!', 'error', false);">
									PAGAR (MERCADOPAGO)
								</button>
							</div>
							<button id="btn_pedir_agora" class="btn_full enviarpedido" <?php if(isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'true') { echo 'disabled'; } ?>>
								<?php $texto['msg_pedir_agora']; ?>
							</button>
						<?php } else if ($type_pay == 1) { ?>
							<button id="btn_pedir_agora" class="btn_full enviarpedido btn_disabled" <?php if (isset($_POST['opcao_delivery']) && $_POST['opcao_delivery'] == 'true') echo 'disabled'; ?>>
								<?php $texto['msg_pedir_agora']; ?>
							</button>
						<?php } else if ($type_pay == 2) { ?>
							<div id="div_script_btn">
								<!--<script id="script_btn" data-summary-shipping="68" src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js" data-preference-id="726027488-a8e1009d-a93a-42e7-b60e-f136032598e9"></script>-->
								<button id="btn_pay_mp" type="button" class="mercadopago-button" onclick="x0p('', 'Opss... Preencha todos os campos!', 'error', false);">
									PAGAR (MERCADOPAGO)
								</button>
							</div>
						<?php } else if ($type_pay == 3) { ?>
							<button id="btn_pay_ps" type="button" class="pagseguro-button" onclick="x0p('', 'Opss... Preencha todos os campos!', 'error', false);">
								PAGAR (PAGSEGURO)
							</button>
						<?php } else if ($type_pay == 4) { ?>
							<button id="btn_pay_ps" type="button" class="pagseguro-button" onclick="x0p('', 'Opss... Preencha todos os campos!', 'error', false);">
								PAGAR (PAGSEGURO)
							</button>
							<div id="div_script_btn">
								<!--<script id="script_btn" data-summary-shipping="68" src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js" data-preference-id="726027488-a8e1009d-a93a-42e7-b60e-f136032598e9"></script>-->
								<button id="btn_pay_mp" type="button" class="mercadopago-button" onclick="x0p('', 'Opss... Preencha todos os campos!', 'error', false);">
									PAGAR (MERCADOPAGO)
								</button>
							</div>
						<?php } ?>
						<!--<button id="btn_pedir_agora" class="btn_full enviarpedido">
									<?php $texto['msg_pedir_agora']; ?>
								</button>-->
						<a class="btn_full_outline" href="<?php $site . $Url[0]; ?>">
							<i class="icon-right"></i>
							<?php $texto['msg_add_mai']; ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div id="resultadoGetcliente"></div>
	<div id="resultadoEnviarPedido"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var iduserr = <?php $getu; ?>;
		var s = 0.00;
		var timer = window.setInterval(checkFieldsTimer, 1500);

		$('.js-example-basic-single').select2();

		$("#v-total-p").text(totalSemFormatacao.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}));

		$("#taxaDelivery").text(parseFloat(pegaTaxa).toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}));

		$('.getBairro').change(function() {
			var idDoLocal = $(this).val();

			$.ajax({
				url: '<?php $site; ?>includes/processaGetLocal.php',
				method: "post",
				dataType: 'json',
				data: {
					'idLocal': idDoLocal,
					'iduserrr': <?php $getu; ?>
				},

				success: function(data) {
					$("#cidade").val(data.cidade);
					$("#uf").val(data.uf);
					$("#valor_taxa").val(data.taxa);
					$("#bairro2").val(data.bairro);
					$('#taxaDelivery').text(data.taxa)

					s = parseFloat(data.taxa);
					soma = parseFloat(totalSemFormatacao) + parseFloat(s);

					$("#v-total-p").text(soma.toLocaleString('pt-BR', {
						style: 'currency',
						currency: 'BRL'
					}));
					$("#taxaDelivery").text(s.toLocaleString('pt-BR', {
						style: 'currency',
						currency: 'BRL'
					}));

					document.getElementById('btn_pedir_agora').disabled = false;

					mpay("change");
					ppay("change");
				}
			});
		});

		//Recupera o valor para validar o campo troco.
		$('#forma_pagamento').change(function() {
			var tell = $(this).val();

			if (tell == "Dinheiro" || tell == "DINHEIRO" || tell == "dinheiro") {
				$('#valor_troco').prop('disabled', false);
			} else {
				$('#valor_troco').val('0,00');
				$('#valor_troco').prop('disabled', true);
			}
		});

		//Quando o campo telefone perde o foco.
		$("#telefone").blur(function() {
			//Nova variável "numerowhats" somente com dígitos.
			var numerowhats = $(this).val().replace(/\D/g, '');

			$.ajax({
				url: '<?php $site; ?>includes/processagetdadoscliente.php',
				method: "post",
				data: {
					'numerocliente': numerowhats,
					'iduser': iduserr
				},

				success: function(data) {
					$('#resultadoGetcliente').html(data);
				}
			});
		});

		$("#cep").change(function() {
			var cep = $("#cep").val();
			if (cep.length == 8) {
				$.ajax({
					url: '<?php $site; ?>includes/api_cep.php',
					method: "post",
					dataType: "json",
					data: {
						'cep': cep
					},

					success: function(data) {
						var res = data;
						//alert(res['logradouro']);
						$("#cidade").attr("value", res['localidade'])
						$("#uf").attr("value", res['uf'])
						$("#rua").attr("value", res['logradouro'])
						//$("#unidade").attr("value",res['logradouro'])
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(xhr.status);
						alert(thrownError);
						alert(xhr.responseText);
					}
				});
			}
		});

		$('.enviarpedido').click(function() {
			$('.enviarpedido').html('AGUARDE...');
			$('.enviarpedido').prop('disabled', true);

			$.ajax({
				url: '<?php $site; ?>includes/processaenviarpedido.php',
				method: "post",
				data: $('#getDadosPedidoCompleto').serialize(),

				success: function(data) {
					$('#resultadoEnviarPedido').html(data);
					$('.enviarpedido').html(
						'<?php $texto['msg_pedir_agora']; ?>');
					$('.enviarpedido').prop('disabled', false);
				}
			});

		});
	});

	function deliveryRateCalculate() {
		$("#v-total-p").text(totalSemFormatacao.toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}));

		$("#taxaDelivery").text(parseFloat(pegaTaxa).toLocaleString('pt-BR', {
			style: 'currency',
			currency: 'BRL'
		}));

		var street = $("#rua").val();
		var number = $("#xx55").val();
		var city = $("#cidade").val();
		var state = $("#uf").val();

		if (!street.trim().length || !number.trim().length || !city.trim().length && !state.trim().length) {
			console.log('aaa');
			return;
		}

		$.ajax({
			url: '<?php $site; ?>includes/processaGetLocal.php',
			method: "post",
			dataType: 'json',
			data: {
				'iduserrr': <?php $getu; ?>,
				'delivery': {
					'street': street,
					'number': number,
					'city': city,
					'state': state
				}
			},

			success: function(data) {
				if (data.available) {
					$("#valor_taxa").val(data.taxa);
					$('#taxaDelivery').text(data.taxa);

					s = parseFloat(data.taxa);
					soma = parseFloat(totalSemFormatacao) + parseFloat(s);

					$("#v-total-p").text(soma.toLocaleString('pt-BR', {
						style: 'currency',
						currency: 'BRL'
					}));
					$("#taxaDelivery").text(s.toLocaleString('pt-BR', {
						style: 'currency',
						currency: 'BRL'
					}));

					document.getElementById('btn_pedir_agora').disabled = false;

					mpay("change");
					ppay("change");
				} else {
					alert('Entrega não disponível para este endereço!');
				}
			}
		});
	}

	function mpay(action) {
		if (!checkFields()) {
			//alert("Preencha os campos!");
			return;
		}

		$("#btn_pay_mp").attr("disabled");
		$("#btn_pay_mp").removeAttr("onclick");
		$("#btn_pay_mp").html("AGUARDE...");

		if(isset($_POST['opcao_delivery']) && !empty($_POST['opcao_delivery']) && !is_null($_POST['opcao_delivery'])) {
			var opcao_delivery = '<?php $_POST['opcao_delivery']; ?>';
		}
		data = new FormData();

		if (isset(opcao_delivery) && !empty(opcao_delivery) && opcao_delivery == "true") {
			data.append('action', 'add');
			data.append('user', <?php $getu; ?>);
			data.append('taxa_v', $("#valor_taxa").val());
			data.append('sub_total', $("#sub_total").val());
			data.append('telefone', $("#telefone").val());
			data.append('nome', $("#nome").val());
			data.append('bairro', ($("#framework").length > 0 ? $("#framework option:selected").html() : $("#bairro")
				.val()));
			data.append('cidade', $("#cidade").val());
			data.append('uf', $("#uf").val());
			data.append('rua', $("#rua").val());
			data.append('unidade', $("#unidade").val());
			data.append('complemento', $("#complemento").val());
			data.append('confirm_whatsapp', $("#green").prop("checked"));
			data.append('opcao_delivery', $("#opcao_delivery").val());
		} else if (opcao_delivery == "false") {
			//alert("falseeee");
			data.append('action', 'add');
			data.append('user', '<?php $getu; ?>');
			data.append('taxa_v', $("#valor_taxa").val());
			data.append('sub_total', $("#sub_total").val());
			data.append('telefone', $("#telefone").val());
			data.append('nome', $("#nome").val());
			//data.append('bairro',($("#framework").length > 0 ? $("#framework option:selected").html() : $("#bairro").val()));
			//data.append('cidade',$("#cidade").val());
			//data.append('uf',$("#uf").val());
			//data.append('rua',$("#rua").val());
			//data.append('unidade',$("#unidade").val());
			//data.append('complemento',$("#complemento").val());
			data.append('confirm_whatsapp', $("#green").prop("checked"));
			data.append('opcao_delivery', $("#opcao_delivery").val());
		} else if (opcao_delivery == "false2") {
			//alert("falseeee");
			data.append('action', 'add');
			data.append('user', '<?php $getu; ?>');
			data.append('taxa_v', $("#valor_taxa").val());
			data.append('sub_total', $("#sub_total").val());
			data.append('telefone', $("#telefone").val());
			data.append('nome', $("#nome").val());
			data.append('mesa', $("#mesa").val());
			data.append('pessoas', $("#pessoas").val());
			data.append('name_observacao_mesa', $("#name_observacao_mesa").val());
			//data.append('bairro',($("#framework").length > 0 ? $("#framework option:selected").html() : $("#bairro").val()));
			//data.append('cidade',$("#cidade").val());
			//data.append('uf',$("#uf").val());
			//data.append('rua',$("#rua").val());
			//data.append('unidade',$("#unidade").val());
			//data.append('complemento',$("#complemento").val());
			data.append('confirm_whatsapp', $("#green").prop("checked"));
			data.append('opcao_delivery', $("#opcao_delivery").val());
		}

		$.ajax({
			url: '<?php $site; ?>includes/mpay.php',
			method: "post",
			//dataType: "json",
			processData: false,
			contentType: false,
			/*data: { "action" : "add", "user" : <?php $getu; ?>, "taxa_v" : $("#valor_taxa").val(), "sub_total" : $("#sub_total").val(), 
					"telefone" : $("#telefone").val(), "nome" : $("#nome").val(), "bairro" : $("#framework option:selected").html(),
					"cidade" : $("#cidade").val(), "uf" : $("#uf").val(), "rua" : $("#rua").val(),
					"unidade" : $("#unidade").val(), "complemento" : $("#complemento").val(), "confirm_whatsapp" : $("#green").prop("checked"), "opcao_delivery" : $("#opcao_delivery").val() },*/
			data: data,
			success: function(response) {
				var res = response;

				if (res.toString() == "fields") {
					return;
				}
				else if (isset($minimo_delivery) && !empty($minimo_delivery) && !is_null($minimo_delivery) && res.toString() == "min_delivery") {
					$("#btn_pay_mp").attr("onclick",
						"x0p('', 'Opss... O valor mínimo do delivery e de R$ <?php (Check::Real($minimo_delivery)); ?>', 'error', false);"
					)
					$("#btn_pay_mp").removeAttr("disabled");
					$("#btn_pay_mp").html("PAGAR (MERCADOPAGO)");
					return;
				} 
				else if (res.toString().toUpperCase().indexOf("UNDEFINED") != -1) {
					$("#btn_pay_mp").attr("onclick",
						"x0p('', 'Opss... O token de acesso é inválido!', 'error', false);")
					$("#btn_pay_mp").removeAttr("disabled");
					$("#btn_pay_mp").html("PAGAR (MERCADOPAGO)");
					return;
				}

				if (action == "change") {
					//$("#div_script_btn").html(" ");
					//$("#div_script_btn").html('<button id="btn_pay_mp" type="button" class="mercadopago-button" onclick="window.open(\''+res.toString()+'\',\'_blank\')">Pagar Agora</button>');

					$("#btn_pay_mp").attr("onclick", "window.open('" + res.toString() + "','_blank');")
					$("#btn_pay_mp").removeAttr("disabled");
					$("#btn_pay_mp").html("PAGAR (MERCADOPAGO)");
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			}
		});
	}

	function ppay(action) {
		if (!checkFields()) {
			//alert("Preencha os campos!");
			return;
		}

		$("#btn_pay_ps").attr("disabled");
		$("#btn_pay_ps").removeAttr("onclick");
		$("#btn_pay_ps").html("AGUARDE...");

		if(isset($_POST['opcao_delivery']) && !empty($_POST['opcao_delivery']) && !is_null($_POST['opcao_delivery'])) {
			var opcao_delivery = '<?php $_POST['opcao_delivery']; ?>';
		}

		data = new FormData();
		if (isset(opcao_delivery) && opcao_delivery == "true") {
			data.append('action', 'add');
			data.append('user', <?php $getu; ?>);
			data.append('taxa_v', $("#valor_taxa").val());
			data.append('sub_total', $("#sub_total").val());
			data.append('telefone', $("#telefone").val());
			data.append('nome', $("#nome").val());
			data.append('bairro', ($("#framework").length > 0 ? $("#framework option:selected").html() : $("#bairro")
				.val()));
			data.append('cidade', $("#cidade").val());
			data.append('uf', $("#uf").val());
			data.append('rua', $("#rua").val());
			data.append('unidade', $("#unidade").val());
			data.append('complemento', $("#complemento").val());
			data.append('confirm_whatsapp', $("#green").prop("checked"));
			data.append('opcao_delivery', $("#opcao_delivery").val());
		} else if (opcao_delivery == "false") {
			//alert("falseeee");
			data.append('action', 'add');
			data.append('user', '<?php $getu; ?>');
			data.append('taxa_v', $("#valor_taxa").val());
			data.append('sub_total', $("#sub_total").val());
			data.append('telefone', $("#telefone").val());
			data.append('nome', $("#nome").val());
			//data.append('bairro',($("#framework").length > 0 ? $("#framework option:selected").html() : $("#bairro").val()));
			//data.append('cidade',$("#cidade").val());
			//data.append('uf',$("#uf").val());
			//data.append('rua',$("#rua").val());
			//data.append('unidade',$("#unidade").val());
			//data.append('complemento',$("#complemento").val());
			data.append('confirm_whatsapp', $("#green").prop("checked"));
			data.append('opcao_delivery', $("#opcao_delivery").val());
		} else if (opcao_delivery == "false2") {
			//alert("falseeee");
			data.append('action', 'add');
			data.append('user', '<?php $getu; ?>');
			data.append('taxa_v', $("#valor_taxa").val());
			data.append('sub_total', $("#sub_total").val());
			data.append('telefone', $("#telefone").val());
			data.append('nome', $("#nome").val());
			data.append('mesa', $("#mesa").val());
			data.append('pessoas', $("#pessoas").val());
			data.append('name_observacao_mesa', $("#name_observacao_mesa").val());
			//data.append('bairro',($("#framework").length > 0 ? $("#framework option:selected").html() : $("#bairro").val()));
			//data.append('cidade',$("#cidade").val());
			//data.append('uf',$("#uf").val());
			//data.append('rua',$("#rua").val());
			//data.append('unidade',$("#unidade").val());
			//data.append('complemento',$("#complemento").val());
			data.append('confirm_whatsapp', $("#green").prop("checked"));
			data.append('opcao_delivery', $("#opcao_delivery").val());
		}

		$.ajax({
			url: '<?php $site; ?>includes/ppay.php',
			method: "post",
			//dataType: "json",
			processData: false,
			contentType: false,
			/*data: { "action" : "add", "user" : <?php $getu; ?>, "taxa_v" : $("#valor_taxa").val(), "sub_total" : $("#sub_total").val(), 
					"telefone" : $("#telefone").val(), "nome" : $("#nome").val(), "bairro" : $("#framework option:selected").html(),
					"cidade" : $("#cidade").val(), "uf" : $("#uf").val(), "rua" : $("#rua").val(),
					"unidade" : $("#unidade").val(), "complemento" : $("#complemento").val(), "confirm_whatsapp" : $("#green").prop("checked"), "opcao_delivery" : $("#opcao_delivery").val() },*/
			data: data,
			success: function(response) {
				var res = response;
				//alert("aaaa");
				//alert(res.toString());
				if (res.toString() == "fields") {
					return;
				} else if(isset($minimo_deliver) && !empty($minimo_deliver) && !is_null($minimo_deliver) && res.toString() == "min_delivery") {
					$("#btn_pay_ps").attr("onclick",
						"x0p('', 'Opss... O valor mínimo do delivery e de R$ <?php (Check::Real($minimo_delivery)); ?>', 'error', false);"
					)
					$("#btn_pay_ps").removeAttr("disabled");
					$("#btn_pay_ps").html("PAGAR (PAGSEGURO)");
					return;
				} else if (res.toString().toUpperCase().indexOf("UNDEFINED") != -1) {
					$("#btn_pay_ps").attr("onclick",
						"x0p('', 'Opss... O código de pagamento não foi gerado corretamente, atualize a página!', 'error', false);"
					)
					$("#btn_pay_ps").removeAttr("disabled");
					$("#btn_pay_ps").html("PAGAR (PAGSEGURO)");
					return;
				}

				if (action == "change") {
					//$("#div_script_btn").html(" ");
					//$("#div_script_btn").html('<button id="btn_pay_ps" type="button" class="mercadopago-button" onclick="window.open(\''+res.toString()+'\',\'_blank\')">Pagar Agora</button>');

					$("#btn_pay_ps").attr("onclick", "window.open('" + res.toString() + "','_blank');")
					$("#btn_pay_ps").removeAttr("disabled");
					$("#btn_pay_ps").html("PAGAR (PAGSEGURO)");
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				alert(xhr.responseText);
			}
		});
	}

	function checkFields() {
		if(isset($_POST['opcao_delivery']) && !empty($_POST['opcao_delivery']) && !is_null($_POST['opcao_delivery'])) {
			var opcao_delivery = '<?php $_POST['opcao_delivery']; ?>';

			if (opcao_delivery == "true") {
				if ($("#telefone").val() == "" ||
					$("#nome").val() == "" ||
					($("#framework").length > 0 && $("#framework option:selected").val() == "") ||
					($("#bairro").length > 0 && $("#bairro").val() == "") ||
					$("#cidade").val() == "" ||
					$("#uf").val() == "" ||
					$("#rua").val() == "" ||
					$("#unidade").val() == "" ||
					$("#forma_pagamento option:selected").val() == "") {
					return false;
				}
				return true;
			} 
			else if (opcao_delivery == "false") {
				if ($("#telefone").val() == "" ||
					$("#nome").val() == "") {
					return false;
				}
				return true;
			} 
			else if (opcao_delivery == "false2") {
				if ($("#telefone").val() == "" ||
					$("#nome").val() == "" ||
					$("#mesa").val() == "" ||
					$("#pessoas").val() == "" ||
					$("#name_observacao_mesa").val() == "") {
					return false;
				}
				return true;
			}
		}
	}

	function checkFieldsTimer() {
		if (checkFields()) {
			mpay("change");
			ppay("change");
			clearInterval(timer);
		}
	}
</script>

<?php if(isset($type_pay) && !empty($type_pay)) {
	if($type_pay == 0 or $type_pay == 2 or $type_pay == 3 or $type_pay == 4) { ?>
	<script>
		$("#forma_pagamento").change(function() {
			var sel = $("#forma_pagamento").val().toUpperCase();
			if (sel.indexOf("CARTÃO") != -1 || sel.indexOf("CRÉDITO") != -1) {
				mpay("change");
				ppay("change");
			}
		});

		$(window).load(function() {
			//mpay("load");
		});
	</script>
	<?php }
} ?>

<style>
	button.mercadopago-button {
		border: none;
		font-family: inherit;
		color: #fff;
		width: 100%;
		background: #41B8F3;
		cursor: pointer;
		padding: 12px 20px;
		outline: none;
		font-size: 15px;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		transition: all 0.3s;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		text-transform: uppercase;
		font-weight: bold;
		display: block;
		text-align: center;
		margin-bottom: 5px;
	}

	button.mercadopago-button:hover {
		background: #000000;
	}

	button.pagseguro-button {
		border: none;
		font-family: inherit;
		color: #fff;
		width: 100%;
		background: #4AD17C;
		cursor: pointer;
		padding: 13px 20px;
		outline: none;
		font-size: 15px;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		transition: all 0.3s;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		text-transform: uppercase;
		font-weight: bold;
		display: block;
		text-align: center;
		margin-bottom: 5px;
	}

	button.pagseguro-button:hover {
		background: #000000;
	}
</style>