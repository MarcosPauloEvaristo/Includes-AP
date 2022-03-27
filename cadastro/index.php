<?php
ob_start();
session_cache_expire(60);
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$site = HOME;

$login = new Login(3);

if($login->CheckLogin()):
  $idusuar = $_SESSION['userlogin']['user_id'];
  $lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");

  if (!$lerbanco->getResult()):       
  else:
    foreach ($lerbanco->getResult() as $i):
      extract($i);
    endforeach;
    header("Location: {$site}{$nome_empresa_link}/estatisticas");
  endif;

else:
endif;
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title><?=$texto['titulo_site_landing'];?></title>
  <meta name="robots" content="index, fallow" />
  <link rel="canonical" href="<?=$site;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <meta name="keywords" content="<?=$texto['keywords_landing'];?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="author" content="<?=$texto['autor_site_landing'];?>">
  <meta property="og:site_name" content="<?=$texto['nome_site_landing'];?>"/>
  <meta property="og:url" content="<?=$site;?>"/>
  <meta name="description" content="<?=$texto['descricao_site_landing'];?>" />
  <meta property="og:description" content="<?=$texto['descricao_site_landing'];?>" />

  <!-- Favicons-->
  	<link rel="icon" type="image/png" href="images/icons/anotarpedido.png"/>
  

  <!-- GOOGLE WEB FONT -->
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>

  <!-- BASE CSS -->
  <link href="<?= $site; ?>css/base.css" rel="stylesheet">

  <!-- Radio and check inputs -->
  <link href="<?= $site; ?>css/skins/square/grey.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

    <script src="<?=$site;?>js/jquery-2.2.4.min.js"></script>

    <link href="<?= $site; ?>css/x0popup-master/dist/x0popup.min.css" rel="stylesheet">
    <script src="<?= $site; ?>css/x0popup-master/dist/x0popup.min.js"></script>

  </head>

  <body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
  <![endif]-->

  <div id="preloader">
    <div class="sk-spinner sk-spinner-wave" id="status">
      <div class="sk-rect1"></div>
      <div class="sk-rect2"></div>
      <div class="sk-rect3"></div>
      <div class="sk-rect4"></div>
      <div class="sk-rect5"></div>
    </div>
  </div><!-- End Preload -->

  <!-- Header ================================================== -->
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col--md-4 col-sm-4 col-xs-4">

        </div>
        <nav class="col--md-8 col-sm-8 col-xs-8">
          <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
          <div class="main-menu">
            <div id="header_menu">

            </div>
            <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
            <ul>                
              <li><a href="<?= $site; ?>">Voltar</a></li>
              <li><a href="<?= $site.'login'; ?>">login</a></li>
            </ul>
          </div><!-- End main-menu -->
        </nav>
      </div><!-- End row -->
    </div><!-- End container -->
  </header>
  <!-- End Header =============================================== -->

  <!-- SubHeader =============================================== -->
  <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="<?=$site;?>img/cu88.png" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
        <h1><strong>CADASTRE-SE</strong></h1>
       

        <p></p>
      </div><!-- End sub_content -->
    </div><!-- End subheader -->
  </section><!-- End section -->
  <!-- End SubHeader ============================================ -->





<div id="cadastrar" class="container margin_60">
  <div class="main_title margin_mobile">
    <h2 class="nomargin_top"> <strong>IMFORME SEUS DADOS ABAIXO</strong> </h2>
    <br />
  
	
	<body>
		<div class="container theme-showcase" role="main">
			
			<!-- Button trigger modal -->
			<a data-toggle="modal" data-target="#myModal">
			<strong>TERMOS DE USO</strong>
			</a>
			<!-- Button trigger modal -->
			<a data-toggle="modal" data-target="#myModal">
			<strong>/ POLITICA </strong>
			</a>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title text-center" id="myModalLabel"><strong>TERMOS DE USO / POLITICA</strong></h4>
						</div>
						<div class="modal-body">
							<p>CNPJ:41.027.110/0001-24<p>
							    
							    1.	DEFINIÇÕES
<p>Para os fins destes Termos e da Política de Privacidade e Proteção de Dados, as palavras e expressões abaixo terão os significados definidos a seguir:

●	Conta de Acesso: Conta criada pelo Usuário definida por credenciais, pessoais e intransferíveis, que permitem acesso às áreas restritas da Plataforma e às suas funcionalidades exclusivas, tais como acesso e alteração de dados pessoais, inscrição, criação, edição e remoção de informações, entre outros.
●	Documentos Freeatom: Conjunto de documentos jurídicos que regulam a relação entre o Usuário e a Freeatom, composto pelos presentes Termos e Condições de Uso e pela Política de Privacidade e Proteção dos Dados.
●	Plataforma: Conjunto de website, softwares, layouts, banco de dados, estrutura tecnológica, APIS, páginas e outros de propriedade, mantido e operado pela Freeatom, acessível por meio do domínio www.freeatom.com.br.
●	Política de Privacidade e Proteção de Dados: A política disponibilizada neste contrato contendo as normas de privacidade e proteção de dados dos Usuários, que complementa e integra estes Termos e Condições de Uso.<p>

<p>2.	REGRAS DE UTILIZAÇÃO E SANÇÕES APLICÁVEIS
O Usuário compromete-se a utilizar a Plataforma e seu conteúdo de forma lícita, conforme as leis aplicáveis e os Documentos Freeatom. Assim, o Usuário aceita que não poderá:
●	Acessar a Plataforma da empresa Freeatom utilizando-se de credenciais de terceiros.
●	Acessar a Plataforma ou sistemas relacionados ilicitamente.
●	Burlar mecanismos de autenticação e/ou segurança da Plataforma.
●	Interferir de qualquer forma na segurança da Plataforma.
●	Permitir que terceiros acessem a o Sistema utilizando-se de suas credenciais;
●	Utilizar a Plataforma para fins ilegais ou não previstos nos Documentos.
●	Utilizar mecanismos para obtenção de informações, conteúdos e serviços que não os habilitados na Plataforma.
●	Realizar atos que possam implicar prejuízos ou danos à Freeatom ou a outros Usuários;
●	Realizar atos que limitem ou impeçam o acesso e a utilização do Sistema em condições adequadas, aos demais Usuários.
●	Realizar deliberadamente atos que constituam uma violação ou que contribuam para a violação de qualquer lei aplicável ou de qualquer direito da Freeatom ou de terceiros.
●	Utilizar os domínios da empresa para criar links ou atalhos para páginas de terceiros não associados, independentemente da forma de divulgação de tais links ou atalhos.
●	Inserir na Plataforma qualquer conteúdo ilícito ou de qualquer modo contrário à moral e aos bons costumes ou que viole direitos de terceiros, como, por exemplo, mas não se limitando a, conteúdo pornográfico ou difamatório.
●	Inserir e/ou difundir na Plataforma qualquer conteúdo que incorpore vírus ou outros elementos físicos ou eletrônicos que possam causar dano ou impedir o normal funcionamento da rede, do sistema ou de equipamentos informáticos, do Portal ou de terceiros, ou que provoque, por suas características (tais como forma, extensão etc.), dificuldades no normal funcionamento da Plataforma.
●	Realizar ou permitir engenharia reversa, traduzir, modificar, alterar a linguagem, compilar, descompilar, reproduzir ou de outra maneira dispor da Plataforma e/ou das ferramentas e funcionalidades nele disponibilizadas.
 O Usuário concorda em indenizar, defender e isentar a Freeatom de qualquer medida judicial ou extrajudicial, bem como de qualquer responsabilidade, decorrentes de qualquer violação e/ou infração cometida pelo Usuário, por uma pessoa agindo em nome do Usuário ou por uma pessoa agindo por meio das credenciais do Usuário, em relação à Plataforma.<p>

 <p> A Freeatom se reserva o direito de recusar, suspender, bloquear ou cancelar a Conta de Acesso do Usuário ou a sua compra imediatamente caso o Usuário descumpra qualquer obrigação prevista nos Documentos Freeatom. Nestes casos, a Freeatom se reserva ainda o direito de comunicar às autoridades competentes, a seu exclusivo critério, sem prejuízo das medidas administrativas, extrajudiciais e judiciais que julgar convenientes.<p>

<p>3.	CONTA DE ACESSO
  Para acessar todas as ferramentas e funcionalidades da Plataforma, o Usuário deverá criar uma Conta de acesso. Cada Usuário poderá criar apenas uma Conta de Acesso e se reserva o direito de cancelar quaisquer Contas de Acesso criadas em duplicidade.<p>

 <p>É proibida também a criação de novas Contas de Acesso por Usuários que tiveram suas Contas de Acesso anteriormente canceladas por infrações aos Documentos Termos de Uso e Politicas de Privacidade apresentada ao usuario, a não ser por exceção e confirmação da autorização  administrativa da empresa.<p>

<p> Toda pessoa natural civilmente capaz, de acordo com o Código Civil, pode criar uma Conta de Acesso. Pessoas absolutamente ou relativamente incapazes poderão utilizar a Plataforma, caso sejam representados e/ou assistidos por seus responsáveis legais (que serão reputados civil e criminalmente responsáveis por quaisquer atos praticados pelo representado assistido). A criação de Conta de Acesso por pessoa absoluta ou relativamente incapaz sem representação ou assistência acarretará a responsabilização de seus representantes legais, na forma da lei.<p>

  <p>O Usuário se compromete a fornecer dados completos, precisos, verdadeiros e atuais, responsabilizando-se civil e criminalmente pelos prejuízos causados à Freeatom ou a terceiros pela inexatidão dos dados. O Usuário se obriga a manter seus dados constantemente atualizados.<p>

 <p> As comunicações enviadas pela Freeatom ocorrerão por meio do endereço de e-mail cadastrado pelo Usuário. Cabe ao Usuário manter o seu endereço de e-mail atualizado, de forma a não interromper o fluxo de comunicações entre ambos lados. Excepcionalmente, a Freeatom poderá comunicar-se com o Usuário adotando quaisquer meios constantes da Conta de Acesso.<p>

 <p> A criação de uma Conta de Acesso não implica em qualquer presunção de existência de vínculo formal ou sociedade de qualquer tipo entre o Usuário e a Freeatom, permanecendo cada qual inteira e exclusivamente responsável por suas respectivas atividades.<p>

 <p> Todas as informações trocadas entre a Freeatom e o Usuário é confidencial e coberta pelo privilégio de confidencialidade. <p>
<p>4.	PAGAMENTOS E COMPROVANTES
  Os pagamentos dos produtos comprados através da Plataforma Freeatom deverão ser feitos por meio de cartões de crédito ou débito Visa, MasterCard, American Express entre outros, ou Via Digital, PagSeguro, PayPal entre outros ou boleto Bancário gerado pela empresa parceira responsável pelo processamento de pagamentos, des de que o pagamento haja comprovante de transação para melhor confiabilidade e comunicação.<p>

  <p>O Usuário autoriza a Freeatom a debitar automaticamente no cartão de crédito indicado os valores previstos no processo de compra e nas requisições de produtos feitas na Plataforma Freeatom Esta autorização é irrevogável e terá validade enquanto existirem valores a serem pagos pelo Usuário.<p>

  <p>A Freeatom empregará seus melhores esforços para o correto processamento do pagamento. Caso o pagamento não seja autorizado pela administradora do cartão de crédito, o Usuário será imediatamente contatado para regularização da pendência. A Freeatom não se responsabiliza em hipótese alguma por eventuais problemas de acesso experimentados pelo Usuário devido à falta de pagamento de qualquer valor devido.<p>

 <p> O envio dos produtos contratados só ocorrerá após a aprovação do pagamento integral pela administradora do cartão de crédito. Neste momento, a Freeatom enviará um e-mail de confirmação do pagamento, contendo ainda a nota fiscal e a nota de débito detalhando o pagamento.<p>

 <p>Inadimplemento. Caso o Usuário deixe de quitar qualquer valor devido, serão cobrados multa de 10% (dez por cento) sobre o valor devido e juros de 0,3% ao dia. Caso o inadimplemento perdure por 30 dias ou mais, a Freeatom  poderá tomar de medidas creditícias, como o envio da informação do inadimplemento do Usuário ao SPC (Serviço de Proteção ao Crédito) e à SERASA, bem como o Protesto dos Títulos em Cartório até o adimplemento dos valores devidos.<p>
<p>5.	GARANTIAS
  A Plataforma, seus produtos e conteúdos, suas funcionalidades e ferramentas são disponibilizados pela Freeatom tal qual expostos e oferecidos na internet, sem qualquer garantia, expressa ou implícita, quanto ao atendimento das expectativas dos Usuários; à continuidade do acesso à Plataforma ou ao seu conteúdo; à adequação da qualidade da Plataforma ou de seu conteúdo para um determinado fim; e à correção de defeitos, erros ou falhas na Plataforma ou em seu conteúdo. A Freeatom se reserva o direito de unilateralmente modificar, a qualquer momento e sem aviso prévio, a Plataforma, bem como sua configuração, sua apresentação, seu desenho, seu conteúdo, suas funcionalidades, suas ferramentas ou qualquer outro elemento.<p>
<p>6.	RESPONSABILIDADES
  A Freeatom engaja seus melhores esforços para informar, atender e proteger o Usuário. No entanto, o Usuário é o único responsável pela utilização da Plataforma/serviços, de suas ferramentas e funcionalidades. Assim, em nenhuma hipótese, a Freeatom, seus diretores, agentes, representantes, empregados, sócios, parceiros ou prestadores de serviço serão responsabilizados por qualquer dano emergente, indireto, punitivo ou expiatório, lucros cessantes ou outros prejuízos monetários relacionados a qualquer reclamação, ação judicial ou outro procedimento tomado em relação à utilização da Plataforma. 

●	Danos e prejuízos que o Usuário possa experimentar pela indisponibilidade e/ou funcionamento parcial da Plataforma e/ou de todos ou alguns de seus produtos, serviços, informações, conteúdos, funcionalidade e/ou ferramentas, bem como pela incorreção ou inexatidão de qualquer destes elementos;
●	diferenças de preços entre os produtos disponibilizados na Plataforma e oferecidos em outros sites da Freeatom, de qualquer empresa do grupo econômico da Freeatom em todo o território nacional;
●	danos e prejuízos que o Usuário possa experimentar em decorrência de falhas na Plataforma Freeatom que meramente reflitam falhas no servidor ou na conexão de rede, na interação de servidores e serviços de telecomunicações, na adequação dos equipamentos do Usuário ou ainda de interações maliciosas como vírus, softwares que possam danificar o equipamento ou acessar dados do equipamento do Usuário.

  O Usuário se responsabiliza pelo risco envolvido em todas e quaisquer negociações com terceiros que ocorram em decorrência dos produtos adquiridos por meio da Plataforma Freeatom O Usuário concorda com a obrigação de indenizar, em ação regressiva, qualquer prejuízo causado à Freeatom em decorrência de ações que envolvam atos do Usuário.<p>

<p>7.	DIREITOS DE PROPRIEDADE INTELECTUAL

  O conteúdo da Plataforma abrange, mas não se limita a, ilustrações, fotografias, vídeos, aplicativos, software, bases de dados, redes, arquivos, textos, layouts, cabeçalhos e quaisquer outras criações autorais e intelectuais. Tais elementos são de propriedade exclusiva da Freeatom ou de seus respectivos titulares (sendo, neste caos, utilizados mediante autorização) e são protegidos por leis e tratados internacionais, inclusive pelas Leis 9.609/98, 9.610/98 e 9.279/96.

  É estritamente proibida a utilização, a exploração, a imitação e a reprodução integral ou parcial de qualquer obra de titularidade a Freeatom sem prévia autorização por escrito.<p>

<p>8.	DISPOSIÇÕES GERAIS

  Princípio de respeito aos Usuários: A Freeatom tem como princípio o respeito ao Usuário, sempre agindo em conformidade com o Código de Proteção e Defesa do Consumidor (Lei n. 8078/90), o Marco Civil da Internet (Lei n. 12965/14) e as normas relativas ao comércio eletrônico.   
  Atualização: Os Documentos Freeatom poderão ser alterados pela Empresa a qualquer tempo. Neste caso, o Usuário será informado das alterações e terá um prazo não inferior a 15 dias para analisar e aceitar a versão atualizada dos Documentos . A continuidade de acesso ou utilização da Plataforma após o prazo para aceitação das modificações constituirá uma aceitação tácita. Caso o Usuário não esteja de acordo com a alteração dos Documentos, poderá rescindir seu vínculo com a Freeatom por meio de pedido de exclusão da Conta na Plataforma ou entrar em contato com a Canal de Atendimento. Esta rescisão não eximirá, no entanto, o Usuário de cumprir com as obrigações assumidas sob as versões precedentes dos Documentos,  Você pode consultar todas as versões destes documentos . A versão dos Documentos, aplicável a cada caso é aquela da atualização imediatamente anterior à data do acesso à Plataforma ou da Compra.<p>
</p>
						</div>				  
					</div>
				</div>
			</div>		
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
  </body>
</html>
 </div>
 <div class="row">
   <div class="col-md-8 col-md-offset-2">
     <form id="formCadastro" autocomplete="off" method="post"> 

      <div class="row">
       <div class="col-md-6">
        <div class="form-group">
         <label for="nome_empresa">Nome da Loja</label>
         <input type="text" autocomplete="off" id="nome_empresa" name="nome_empresa" class="form-control" required placeholder="Nome da Loja">
       </div>
     </div>
     <div class="col-md-6">
      <div class="form-group">
       <label for="nome_empresa_link"><?=$site;?></label>
       <input style="text-transform: lowercase;" type="text" autocomplete="off"  id="nome_empresa_link" name="nome_empresa_link" class="form-control" required placeholder="/ coloque o nome da sua loja aqui sem espaços">
       <a class="btn btn-success btn-xs" id="verificarDisponibilidadeLink" style="color: #ffffff;cursor: pointer;margin-top: 5px;"><strong> verificar Disponibilidade </strong></a>
     </div>
   </div>
 </div><!-- End row  -->
 <div class="row">
   <div class="col-md-12">
    <div class="form-group">
     <label for="cep">Cep</label>
     <input type="text" required class="form-control" name="cep" id="cep" maxlength="10" data-mask="00.000-000" data-mask-selectonfocus="true" placeholder="00.000-000">   
   </div>
 </div>
</div><!-- End row  -->
 <div class="row">
   <div class="col-md-6">
    <div class="form-group">
     <label for="estados">Estado</label>
     <!--<select required class="form-control" name="end_uf_empresa" id="estados">     
     </select>-->  
     <input type="text" autocomplete="off" id="end_uf_empresa" required name="end_uf_empresa" class="form-control" placeholder="Estado/UF...">
   </div>
 </div>
 <div class="col-md-6">
  <div class="form-group">
   <label for="cidades">Cidade</label>
   <!--<select required class="form-control" name="cidade_empresa" id="cidades">    
   </select>-->
   <input type="text" autocomplete="off" id="cidade_empresa" required name="cidade_empresa" class="form-control" placeholder="Estado/UF...">
 </div>
</div>
</div><!-- End row  -->
<div class="row">
 <div class="col-md-6">
  <div class="form-group">
   <label for="end_bairro_empresa">Bairro</label>
   <input type="text" autocomplete="off" id="end_bairro_empresa" required name="end_bairro_empresa" class="form-control" placeholder="Bairro...">
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <label for="end_rua_n_empresa">Endereço Completo</label>
   <input type="text" autocomplete="off" id="end_rua_n_empresa" required name="end_rua_n_empresa" class="form-control" placeholder="Rua e Nº">
 </div>
</div>
</div><!-- End row  -->
<hr />
<div class="row">
 <div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_name">Nome</label>
   <input type="text" required autocomplete="off" class="form-control" id="user_name" name="user_name" placeholder="Seu Nome">
 </div>
</div>
<div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_lastname">Sobrenome</label>
   <input type="text" required autocomplete="off"  class="form-control" id="user_lastname" name="user_lastname" placeholder="Seu Sobrenome">
 </div>
</div>
</div>
<div class="row">
 <div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_email">E-mail: (será usado para Login)</label>
   <input type="email" required autocomplete="off" id="user_email" name="user_email" class="form-control " placeholder="E-mail">
 </div>
</div>
<div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_telefone">Telefone para contato:</label>
   <input type="tel" required autocomplete="off"  id="user_telefone" name="user_telefone" class="form-control" placeholder="(99) 99999-9999" data-mask="(00) 00000-0000" maxlength="15">
 </div>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <div class="form-group">
   <label for="user_password">Senha</label>
   <input type="password" required autocomplete="off" class="form-control" placeholder="*******" name="user_password"  id="user_password" />
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <label for="user_password2">Repita a Senha</label>
   <input type="password" required autocomplete="off"  class="form-control" placeholder="*******" name="user_password2"  id="user_password2" />
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <label for="user_password2">Coloque seu CPF</label>
   <input type="text" required autocomplete="off"  class="form-control cpf" placeholder="Insira aqui" name="user_cpf"  id="user_cpf" />
 </div>
</div>
</div><!-- End row  -->
<div class="form-group">
  <label>Escolha seu plano</label>
  <select name="user_plano" class="form-control" >
    <option value="">Selecione um Plano</option>
    <option value="1"><?=$texto['nomePlanoUm'];?></option>
    <option value="2"><?=$texto['nomePlanoDois'];?></option>
    <option value="3"><?=$texto['nomePlanoTres'];?></option>
  </select>
</div>
<div class="icheck-material-green">
												<input type="checkbox" name="" value="false" id />
												<label for=""><strong>ACEITO OS TERMOS DE USO
											<p> </strong></label>
											</div>
<div id="pass-info" class="clearfix"></div>

<!--
<div class="row">
 <div class="col-md-6">
   <label>Leia os <a href="#0">termos e condições.</a></label>
 </div>
</div>End row  -->
<hr style="border-color:#ddd;">

<div class="text-center">
  <input type="hidden" name=" empresa_status" value="true">
  <button type="button" id="cadastrarUser" class="btn_full_outline">Cadastrar Minha Loja</button>.
</div>
</form>
</div><!-- End col  -->
</div><!-- End row  -->
</div><!-- End container  -->
<!-- End Content =============================================== -->


<!-- Footer ================================================== -->
<footer>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div id="social_footer">
          <ul>
            <li><a target="_blank" href="<?=(!empty($texto['link_do_face']) ? $texto['link_do_face'] : "");?>"><i class="icon-facebook"></i></a></li>
            <!--<li><a href="#0"><i class="icon-twitter"></i></a></li>-->
            <!--<li><a href="#0"><i class="icon-google"></i></a></li>-->
            <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="icon-instagram"></i></a></li>
            <!--<li><a href="#0"><i class="icon-pinterest"></i></a></li>-->
            <!--<li><a href="#0"><i class="icon-vimeo"></i></a></li>-->
            <li><a target="_blank" href="<?=(!empty($texto['link_do_youtube']) ? $texto['link_do_youtube'] : "");?>"><i class="icon-youtube-play"></i></a></li>
          </ul>
          <p>© <?=$texto['nome_site_landing'];?></p>
        </div>
      </div>
    </div><!-- End row -->
  </div><!-- End container -->
</footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   
<div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content modal-popup">
    <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    <form action="#" class="popup-form" id="myLogin">
     <div class="login_icon"><i class="icon_lock_alt"></i></div>
     <input type="text" class="form-control form-white" placeholder="Username">
     <input type="text" class="form-control form-white" placeholder="Password">
     <div class="text-left">
      <a href="#">Forgot Password?</a>
    </div>
    <button type="submit" class="btn btn-submit">Submit</button>
  </form>
</div>
</div>
</div><!-- End modal -->   

<!-- Register modal -->   
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content modal-popup">
    <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    <form action="#" class="popup-form" id="myRegister">
     <div class="login_icon"><i class="icon_lock_alt"></i></div>
     <input type="text" class="form-control form-white" placeholder="Name">
     <input type="text" class="form-control form-white" placeholder="Last Name">
     <input type="email" class="form-control form-white" placeholder="Email">
     <input type="text" class="form-control form-white" placeholder="Password"  id="password1">
     <input type="text" class="form-control form-white" placeholder="Confirm password"  id="password2">
     <div id="pass-info" class="clearfix"></div>
     <div class="checkbox-holder text-left">
      <div class="checkbox">
       <input type="checkbox" value="accept_2" id="check_2" name="check_2" />
       <label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
     </div>
   </div>
   <button type="submit" class="btn btn-submit">Register</button>
 </form>
</div>
</div>
</div><!-- End Register modal -->

<!-- Search Menu -->
<div class="search-overlay-menu">
  <span class="search-overlay-close"><i class="icon_close"></i></span>
  <form role="search" id="searchform" method="get">
   <input value="" name="q" type="search" placeholder="Search..." />
   <button type="submit"><i class="icon-search-6"></i>
   </button>
 </form>
</div>
<!-- End Search Menu -->

<!-- COMMON SCRIPTS -->
<script src="<?= $site; ?>js/jquery-2.2.4.min.js"></script>
<script src="<?= $site; ?>assets/validate.js"></script>
<script src="<?=$site;?>js/common_scripts_min.js"></script>
<script src="<?=$site;?>js/functions.js"></script>
<script src="<?=$site;?>assets/validate.js"></script>
<script src="<?=$site; ?>notificacao/growl-notification.min.js"></script> 
<script src="<?=$site;?>assets/sweetalert.min.js"></script>
<script src="<?=$site;?>js/jquery.mask.js"></script>
<script src="<?=$site;?>js/suportewats.js"></script>

<script>

  $('#dinheiro').mask('#.##0,00', {reverse: true});
  $('.telefone').mask('(00) 0 0000-0000');
  $('.estado').mask('AA');
  $('.cpf').mask('000.000.000-00');
  $('.cnpj').mask('00.000.000/0000-00');
  $('.rg').mask('00.000.000-0');
  $('.cep').mask('00000-000');
  $('.dataNascimento').mask('00/00/0000');
  $('.placaCarro').mask('AAA-0000');
  $('.horasMinutos').mask('00:00');
  $('.cartaoCredito').mask('0000 0000 0000 0000');
  $('.numero').mask('#########0');
  $('.descontoporcentagem').mask('##0');
</script>




<script type="text/javascript">
  // LOGIN
  $(document).ready(function(){
   $("#cadastrarUser").click(function(){
    //formCadastro
    $(this).html('<i class="icon-spin5 animate-spin"></i> AGUARDE...');
    $(this).prop('disabled', true);

    $.ajax({
      url: '<?=$site;?>controlers/processaCadastroUser.php',
      method: 'post',
      data: $('#formCadastro').serialize(),
      success: function(data){
        if(data == "erro1"){
          x0p('Opsss', 
            'Preencha todos os campos!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro2"){
          x0p('Opsss', 
            'O E-mail informado e inválido!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro3"){
          x0p('Opsss', 
            'A senha informada deve ter no mínimo 8 caracteres!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro4"){
          x0p('Opsss', 
            'As senhas não coincidem!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro5"){
          x0p('Opsss', 
            'Esse link não está disponível!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro6"){
          x0p('Opsss', 
            'Já existe uma conta com esses dados!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro66"){
          x0p('Opsss', 
            'O CPF informado e inválido!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro0"){
          x0p('Opsss', 
            'OCORREU UM ERRO AO CADASTRAR!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else{
         x0p('Sucesso!', 
          'Agora você pode fazer login.', 
          'ok', false);
         $('#cadastrarUser').html('Cadastrar Minha Loja');
         $('#cadastrarUser').prop('disabled', false);

       }

     }
   });

  }); 
 });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#verificarDisponibilidadeLink').click(function(){
      var linkuser = $('#nome_empresa_link').val();

      if(linkuser == ''){
        x0p('Opss...', 
          'Antes preencha o campo!',
          'error', false);
      }else{

        $.ajax({
          url: '<?=$site?>controlers/processaverificadisponibilidadelink.php',
          method: 'post',
          data: {'linkuser' : linkuser},
          success: function(data){

            if(data == 'true'){
              x0p('Que pena! 😔', 
                'Esse link não está disponível!',
                'error', false);
            }else{
              $('#nome_empresa_link').val(data);
              x0p('Muito bom! 😍', 
                '<?=$site;?>'+data+' está disponível!', 
                'ok', false);
            }          
          }
        });

      }
    });
  });
</script>

<script type="text/javascript"> 

  $(document).ready(function () {

    $.getJSON('<?=$site;?>estados_cidades.json', function (data) {

      var items = [];
      var options = "<option value='<?=(!empty($end_uf_empresa) ? $end_uf_empresa : "");?>'><?=(!empty($end_uf_empresa) ? $end_uf_empresa : "Escolha um estado");?></option>";    

      $.each(data, function (key, val) {
        options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
      });                 
      $("#estados").html(options);                

      $("#estados").change(function () {              

        var options_cidades = "<option value='<?=(!empty($cidade_empresa) ? $cidade_empresa : "");?>'><?=(!empty($cidade_empresa) ? $cidade_empresa : "Escolha uma Cidade");?></option>";
        var str = "";                   

        $("#estados option:selected").each(function () {
          str += $(this).text();
        });

        $.each(data, function (key, val) {
          if(val.sigla == str) {                          
            $.each(val.cidades, function (key_city, val_city) {
              options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
            });                         
          }
        });

        $("#cidades").html(options_cidades);

      }).change();        

    });

  });
  
  $(document).ready(function() {
	    $("#cep").change(function (){
	        var cep = $("#cep").val();
	        if (cep.length == 10) {
	            $.ajax({
	                url: '<?=$site;?>includes/api_cep.php',
                	method: "post",
                	dataType: "json",
                	data: {'cep' : cep},

                	success: function(data){        
                		var res = data;
                		$("#end_uf_empresa").attr("value",res['uf']);
                		$("#cidade_empresa").attr("value",res['localidade']);
                		$("#end_rua_n_empresa").attr("value",res['logradouro']);
                		$("#end_bairro_empresa").attr("value",res['bairro']);
                	},
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                        alert(xhr.responseText);
                    }
	            });
	        }
	    });
	});

</script>


</body>
</html>

<?php
ob_end_flush();
?>