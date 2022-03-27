<?php
require('../_app/Config.inc.php');
$site = HOME;
$google_maps_api_key = GOOGLE_MAPS_API_KEY;

$pegaidUser = $_POST['iduserrr'];

$lerbanco->ExeRead('delivery_distance_config', "WHERE user_id = :user_id", "user_id={$pegaidUser}");
if (!$lerbanco->getResult()):
	echo '<script type="text/javascript">alert("Ocorreu um erro ao localizar endereço!")</script>';
else:
	$delivery_distance_config_result = $lerbanco->getResult();
	if ($delivery_distance_config_result[0]['type'] == 'district'):
		$PegaId = $_POST['idLocal'];
		$lerbanco->ExeRead('bairros_delivery', "WHERE id = :f and user_id = :userid", "f={$PegaId}&userid={$pegaidUser}");
		if (!$lerbanco->getResult()):
			echo '<script type="text/javascript">alert("Ocorreu um erro ao localizar endereço!")</script>';
		else:
			foreach($lerbanco->getResult() as $i):
				extract($i);
			endforeach;

			$LocalEmjason = array();
			$LocalEmArray['uf'] = $uf;
			$LocalEmArray['cidade'] = $cidade;
			$LocalEmArray['bairro'] = $bairro;
			$LocalEmArray['taxa'] = $taxa;

			echo(json_encode($LocalEmArray));
		endif;
	elseif ($delivery_distance_config_result[0]['type'] == 'distance_rate'):
		$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :user_id", "user_id={$pegaidUser}");
		if (!$lerbanco->getResult()):
			echo '<script type="text/javascript">alert("Ocorreu um erro ao localizar endereço!")</script>';
		else:
			foreach($lerbanco->getResult() as $i):
				extract($i);
			endforeach;

			$origin = urlencode($end_rua_n_empresa . ', ' . $cidade_empresa . ' - ' . $end_uf_empresa);
			$destination = urlencode($_POST['delivery']['street'] . ' - ' . $_POST['delivery']['number'] . ', ' . $_POST['delivery']['city'] . ' - ' . $_POST['delivery']['state']);

			$result = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&language=pt-BR&sensor=false&key=$google_maps_api_key");
			$distanceMatrixResult = json_decode($result);

			if ($distanceMatrixResult->status == 'OK'):
				foreach($distanceMatrixResult->rows as $row):
					foreach($row->elements as $element):
						if ($element->status == 'OK'):
							$lerbanco->ExeRead('delivery_distance_rate', "WHERE user_id = :user_id ORDER BY distance_rate", "user_id={$pegaidUser}");
							if ($lerbanco->getResult()):
								$response = array();
								$response['available'] = FALSE;
								
								foreach($lerbanco->getResult() as $rate):
									if ($element->distance->value <= ($rate['distance_rate'] * 1000)):
										$response['taxa'] = $rate['price'];
										$response['available'] = TRUE;
										break;
									endif;
								endforeach;

								echo(json_encode($response));
							endif;
							break 2;
						endif;
					endforeach;
				endforeach;
			endif;
		endif;
	endif;
endif;