<?php $login = new Login(3);

if($login->CheckLogin()):
  $idusuar = $_SESSION['userlogin']['user_id'];
  $lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
  if (!$lerbanco->getResult()):       
  else:
    foreach ($lerbanco->getResult() as $i):
      extract($i);
    endforeach;
    header("Location: {$site}{$nome_empresa_link}/pedidos");
  endif;
else:
endif;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="zxx">
<!--<![endif]-->

<head><meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php $texto['titulo_site_landing'];?></title>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="assets_land/images/anotarpedido.png">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/bootstrap.css">
    <!--Owl Carousel CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/owl.carousel.min.css">
    <!--Magnific PopUp Stylesheet-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/magnific-popup.css">
    <!--Icofont CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/icofont.css">
    <!--Mailer CSS-->
    <link rel="stylesheet" type="text/css" href="mailer_land/mailer-style.css">
    <!--Animate CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/animate.css">
    <!--Bootsnav CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/bootsnav.css">
    <!--Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/style.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" type="text/css" href="assets_land/css/responsive.css">
 
    <!--Modanizr JS-->
    <script src="" async></script>
    <script src="assets_land/js/modernizr.custom.js"></script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
    <!--Start Preloader-->
    <div class="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!--End Preloader-->

    <!--Start Body Wrap-->
    <div id="body-wrap">
        <!--Start Header-->
        <header id="header">
            <nav class="navbar navbar-default bootsnav" data-spy="affix" data-offset-top="10">
                <div class="container">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="icofont icofont-navigation-menu"></i>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="assets_land/images/logo7.png" class="logo" alt=""></a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeIn" data-out="fadeOut">
                            <li class="active"><a href="#header">Inicio</a></li>
                            <li><a href="#about">Parceiros</a></li>
                            <li><a href="#features">Funcionalidades</a></li>
                            <li><a href="#app-screenshot">Veja o Sistema</a></li>
                            <li><a href="#pricing">Planos</a></li>
                            <li><a href="#faq">FAQ</a></li>
                            <li><a href="#contact">Contato</a></li>
                            <li><a href="<?php echo $site ?>login">Login </a></li>
                            <li><a href="/cadastro"></a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </nav>
            <div class="clearfix"></div>
        </header>
        <!--End Header-->

        <!--Start Banner Section-->
        <section id="banner" class="gradient-bg full-height">
            <!--Start Container-->
            <div class="container">
                <!--Start Row-->
                <div class="row">
                    <!--Start Banner Caption-->
                    <div class="col-md-6">
                        <div class="caption-content">
                            <h1 class="font-700 color-white text-uppercase wow fadeInUp" data-wow-delay="0.1s">Cardápio Digital Online </h1>
                            <p class="color-white wow fadeInUp" data-wow-delay="0.2s">Tenha o Seu Sistema de Cardápio Digital e Receba Pedidos de Forma Automática em Seu Whatsapp e Sem Precisar Pagar Altas Taxas ou Comições. </p>
                            <div class="caption-btn wow fadeInUp" data-wow-delay="0.3s">
                                <a class="gradient-bg-1" href="https://linktr.ee/Anotar_Pedidos>" target="_blank"></i><span class="float-right text-center font-w-700"><strong>CONTATO</strong></a>
                            </div>
                        </div>
                    </div>
                    <!--End Banner Caption-->

                    <!--Start Banner Image-->
                    <div class="col-md-6">
                        <div class="banner-img wow fadeIn" data-wow-delay="0.4s">
                            <img src="assets_land/images/capa87.png" class="img-responsive" alt="Image">
                        </div>
                    </div>
                    <!--End Banner Image-->
                </div>
                <!--End Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Banner Section-->
           
                        

        <!--Start About Section-->
        <section id="about">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                     <!--propaganda-->
                    
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="section-heading text-center">
                            <h2 class="font-700 color-base text-uppercase wow fadeInUp" data-wow-delay="0.1s">PARCEIROS</h2>
                            
                                                         </div>
                    </div>
                    <!--End Heading Content-->
                </div>
                <!--End Heading Row-->

                <!--Start Screenshots Slider-->
                <div class="screenshots-slider owl-carousel wow fadeIn" data-wow-delay="0.2s">
                    <img src="assets_land/images/parceiro1.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/parceiro2.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/parceiro3.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/parceiro4.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/parceiro5.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/parceiro6.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/parceiro7.png" class="img-responsive" alt="Image">
                    
                </div>
                <!--End About Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End About Section-->
  
         <!--Start Why Choose Section-->
        
        <section id="app-screenshot">
            <!--Start Container-->
            <div class="container">
                <!--Start Row-->
                <div class="row">
                    <!--Start Why Choose Content-->
                    
                    <div class="col-md-6">
                        <div class="why-choose-content">
                            <h2 class="font-700 color-base text-uppercase wow fadeInUp" data-wow-delay="0.1s">PRINCIPAIS FERRAMENTAS</h2>
                            <!--Start Why Choose Item-->
                            <div class="why-choose-single fix wow fadeInUp" data-wow-delay="0.1s">
                                <div class="why-chose-icon float-left">
                                    <i class="icofont icofont-restaurant-menu"></i>
                                </div>
                                <div class="why-choose-single-details float-right">
                                    <h5 class="font-600">Cardápio Personalizado</h5>
                                    <p>Tenha um cardápio personalizado do seu gosto com o seu tema, Altere as cores e coloque Banners.</p>
                                </div>
                            </div>
                            <!--End Why Choose Item-->

                            <!--Start Why Choose Item-->
                            <div class="why-choose-single fix wow fadeInUp" data-wow-delay="0.1s">
                                <div class="why-chose-icon float-left">
                                    <i class="icofont icofont-money-bag"></i>
                                </div>
                                <div class="why-choose-single-details float-right">
                                    <h5 class="font-600">Aumente seu Faturamento</h5>
                                    <p>A Inteligencia Artificial atende multi-pedidos te gerando mais <strong> TEMPO</strong> e Dando qualidade de atendimento. </p>
                                </div>
                            </div>
                            <!--End Why Choose Item-->

                            <!--Start Why Choose Item-->
                            <div class="why-choose-single fix wow fadeInUp" data-wow-delay="0.1s">
                                <div class="why-chose-icon float-left">
                                    <i class="icofont icofont-ruler-pencil"></i>
                                </div>
                                <div class="why-choose-single-details float-right">
                                    <h5 class="font-600">Relatorios e Controle Finançeiro </h5>
                                    <p>Voce terá acesso aos Gráficos Detalhados sobre suas finanças, facilitando no controle de entrada e Saida. </p>
                                </div>
                            </div>
                            <!--End Why Choose Item-->

                            <!--Start Why Choose Item-->
                            <div class="why-choose-single fix wow fadeInUp" data-wow-delay="0.1s">
                                <div class="why-chose-icon float-left">
                                    <i class="icofont icofont-link"></i>
                                </div>
                                <div class="why-choose-single-details float-right">
                                    <h5 class="font-600">Link Amigavel</h5>
                                    <p>Oferecemos Link Amigavel para estar utilizando no atendimento. </p>
                                </div> 
                            </div>
                            
                            <!--End Why Choose Item-->
                        </div>
                        
                    </div>
                    <!--End Why Choose Content-->

                    <!--Start Why Choose Image-->
                     <iframe width="400" height="480" src="https://www.youtube.com/embed/T6xmTqXHjZI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><center/>
                     <!--End Container-->
                                 
              </div>
                <!--Start Screenshots Slider-->
                <div class="screenshots-slider owl-carousel wow fadeIn" data-wow-delay="0.1s">
                    <img src="assets_land/images/foto33.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/foto35.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/foto36.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/calabresa.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/nildo.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/image33.jpg" class="img-responsive" alt="Image">
                       <img src="assets_land/images/902.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/901.jpg" class="img-responsive" alt="Image">
                    <img src="assets_land/images/903.jpg" class="img-responsive" alt="Image">
                    
                 </section>
        <!--End Why Choose Section-->
        <!--Start Demo Video Section-->
        <section id="demo-video" class="bg-cover position-relative">
            <div class="overlay"></div>
            <!--Start Container-->
            <div class="container">
                <!--Start Row-->
                <div class="row">
                    <!--Start Video Content-->
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="video-content text-center">
                            <h2 class="font-700 text-uppercase color-white wow fadeInUp" data-wow-delay="0.2s">Demonstração</h2>
                            <p class="color-white wow fadeInUp" data-wow-delay="0.2s">Veja Como Funciona nossa Demonstração e Faça um Pedido.</p>
                            <div class="video-popup-icon position-relative">
                                <div class="pulse1"></div>
                                <div class="pulse2"></div>
                                <a class="popup-video" href="https://anotarpedido.com.br/BigBurguer"><i class="icofont icofont-play-alt-2"></i></a>
                            </div>

            <!--End Container-->
            
        </section>
             
   
                    </div>
     
                        <div class="section-heading text-center">
                            <h2 class="font-700 color-base text-uppercase wow fadeInUp" data-wow-delay="0.1s">BONÛS DESIGNERS</h2>
                            
                     </div>
                    </div>
    
       <!--Start Screenshots Slider-->
               <div class="screenshots-slider owl-carousel wow fadeIn" data-wow-delay="0.2s">
                    <img src="assets_land/images/Foto91.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/foto 92.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/Foto93.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/Foto94.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/Foto95.png" class="img-responsive" alt="Image">
                    <img src="assets_land/images/Foto96.png" class="img-responsive" alt="Image">
                       <img src="assets_land/images/Foto97.png" class="img-responsive" alt="Image">
                <!--End About Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End About Section-->
         
                
        <!--Start Pricing Section-->
        <section id="pricing">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                   
                    <!--Start Heading Content-->
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="section-heading text-center">
                            <h2 class="font-700 color-base text-uppercase wow fadeInUp" data-wow-delay="0.1s">Nossos Planos</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Confira abaixo os valores de nossos planos.</p>
                        </div>
                    </div>
                    <!--End Heading Content-->
                </div>
                <!--End Heading Row-->

                <!--Start Pricing Row-->
                <div class="row">
                    <!--Start Pricing Table-->
                    <div class="col-md-3 col-sm-6">
                        <div class="pricing-table-single text-center wow fadeIn" data-wow-delay="0.1s">
                            <div class="pricing-title">
                                <h3 class="font-700">Teste</h3>
                            </div>
                            <div class="price-amount">
                                <h2 class="font-700 color-base2"><span>Faça o teste</span></h2>
                            </div>
                            <div class="pricing-details">
                                <ul>
                                    <li class="font-500 ">Acesso Total Ao Sistema</li>
                  
                                    <li class="font-500 no">Suporte para Cadastro e Instalação</li>
                                    
                                     <li class="font-500 no">Link Amigavel</li>
                                      <li class="font-500 no">Automação De Whatsapp ChatBot</li>
                                     <li class="font-500 no">Suporte Ao Cliente 24h</li>
                                     <li class="font-500 no">Designers Personalizados Para Divulgação</li>
                                      <li class="font-500 no">Criação de Logo</li>
                                     <li class="font-500 no">E-Book Digital</li>
                                       <li class="font-500 no">Automação Instagram e Facebook</li>
                                    
                                    
                                   
                                        <li class="font-500 no">Cartão De Visita Digital</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a class="font-600" href="https://linktr.ee/Anotar_Pedidos>">Assinar</a>
                            </div>
                        </div>
                    </div>
                    <!--End Pricing Table-->

                    <!--Start Pricing Table-->
                    <div class="col-md-3 col-sm-6">
                        <div class="pricing-table-single text-center wow fadeIn" data-wow-delay="0.2s">
                            <div class="pricing-title">
                                <h3 class="font-700">Básico</h3>
                            </div>
                            <div class="price-amount">
                                <h2 class="font-700 color-base2"><span>R$</span> 69 <sup class="font-800">.00</sup> <sub class="font-600"></sub></h2>
                            </div>
                            <div class="pricing-details">
                                <ul>
                                  <li class="font-500 ">Acesso Total Ao Sistema</li>
                  
                                    <li class="font-500 ">Suporte para Cadastro e Instalação</li>
                                    
                                     <li class="font-500">Link Amigavel</li>
                                              <li class="font-500 ">Automação De Whatsapp ChatBot</li>
                                     <li class="font-500">Suporte Ao Cliente 24h</li>
                                     <li class="font-500 ">Designers Personalizados Para Divulgação</li>
                                      <li class="font-500">Criação de Logo</li>
                                           <li class="font-500 no">E-Book Digital</li>
                                      
                                       <li class="font-500 no">Automação Instagram e Facebook</li>
                                    
                                    
                                   
                                        <li class="font-500 no">Cartão De Visita Digital</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                              <div class="pricing-btn">
                                <a class="font-600" href="https://linktr.ee/Anotar_Pedidos>">Assinar</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--End Pricing Table-->

                    <!--Start Pricing Table-->
                    <div class="col-md-3 col-sm-6">
                        <div class="pricing-table-single text-center wow fadeIn" data-wow-delay="0.3s">
                            <div class="pricing-title">
                                <h3 class="font-700">Plano Trimestral</h3>
                            </div>
                            <div class="price-amount">
                                <h2 class="font-700 color-base2"><span>R$</span> 180 <sup>.00</sup> <sub></sub></h2>
                            </div>
                            <div class="pricing-details">
                                <ul>
                                    <li class="font-500 ">Acesso Total Ao Sistema</li>
                  
                                    <li class="font-500 ">Suporte para Cadastro e Instalação</li>
                                    
                                     <li class="font-500">Link Amigavel</li>
                                               <li class="font-500">Automação De Whatsapp ChatBot</li>
                                     <li class="font-500">Suporte Ao Cliente 24h</li>
                                     <li class="font-500 ">Designers Personalizados Para Divulgação</li>
                                      <li class="font-500">Criação de Logo</li>
                                     <li class="font-500 no">E-Book Digital</li>
                                      
                                       <li class="font-500 no">Automação Instagram e Facebook</li>
                                    
                                    
                                   
                                        <li class="font-500 no">Cartão De Visita Digital</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                 <div class="pricing-btn">
                                <a class="font-600" href="https://linktr.ee/Anotar_Pedidos>">Assinar</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--End Pricing Table-->
                       <!--Start Pricing Table-->
                    <div class="col-md-3 col-sm-6">
                        <div class="pricing-table-single text-center wow fadeIn" data-wow-delay="0.3s">
                            <div class="pricing-title">
                                <h3 class="font-700">Plano Anual</h3>
                            </div>
                            <div class="price-amount">
                                <h2 class="font-700 color-base2"><span>R$</span> 700<sup>.00</sup> <sub></sub></h2>
                            </div>
                            <div class="pricing-details">
                                <ul>
                                    <li class="font-500 ">Acesso Total  Ao Sistema</li>
                  
                                    <li class="font-500 ">Suporte para Cadastro e Instalação</li>
                                    
                                     <li class="font-500">Link Amigavel</li>
                                              <li class="font-500">Automação De Whatsapp ChatBot</li>
                                     <li class="font-500">Suporte Ao Cliente 24h</li>
                                     <li class="font-500 ">Designers Personalizados Para Divulgação</li>
                                     <li class="font-500">Criação de Logo</li>
                                     <li class="font-500 ">E-Book Digital</li>
                                      
                                       <li class="font-500">Automação Instagram e Facebook</li>
                                    
                                    
                                   
                                        <li class="font-500">Cartão De Visita Digital</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                 <div class="pricing-btn">
                                <a class="font-600" href="https://linktr.ee/Anotar_Pedidos>">Assinar</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--End Pricing Table-->
                </div>
                <!--End Pricing Row-->
            </div>
            <!--End Container-->
            
        </section>
        <!--End Pricing Section-->

        <!--Start Faq Section-->
        <section id="faq" class="bg-gray">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                    <!--Start Heading Content-->
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="section-heading text-center">
                            <h2 class="font-700 color-base text-uppercase wow fadeInUp" data-wow-delay="0.1s">Perguntas Frequentes</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Confira abaixo algumas dúvidas frequentes relacionadas a nossa plataforma.</p>
                        </div>
                    </div>
                    <!--End Heading Content-->
                </div>
                <!--End Heading Row-->

                <!--Start Faq Row-->
                <div class="row">
                    <!--Start Faq Accordian-->
                    <div class="col-md-6">
                        <div class="panel-group" id="accordion">
                            <!--Start Accordian Single-->
                            <div class="panel panel-default wow fadeInUp" data-wow-delay="0.1s">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="font-600 accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">A Plataforma é responsiva? funciona bem no celular?  </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="font-500 panel-body">Sim, Funciona Perfeitamente no Celular, e tambem disponibilizamos um App.</div>
                                </div>
                            </div>
                            <!--End Accordian Single-->

                            <!--Start Accordian Single-->
                            <div class="panel panel-default wow fadeInUp" data-wow-delay="0.2s">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="font-600 accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Meu cliente precisa baixar algum aplicativo ? </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="font-500 panel-body">Não, apenas com o link do seu cardápio o cliente pode realizar os pedidos, é totalmente integrado Via Web.</div>
                                </div>
                            </div>
                            
                            <!--End Accordian Single-->

                            <!--Start Accordian Single-->
                            <div class="panel panel-default wow fadeInUp" data-wow-delay="0.3s">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="font-600 accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">O cliente realiza o pagamento pela plataforma ?</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="font-500 panel-body">Sim, Você pode definir Pagamento On-Line pela Plataforma (PAGSEGURO ou MERCADO PAGO) e Tambem via Balcão ou na Entrega, você quem decide asformas de pagamento.</div>
                                </div>
                            </div>
                            <!--End Accordian Single-->

                            <!--Start Accordian Single-->
                            <div class="panel panel-default wow fadeInUp" data-wow-delay="0.4s">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="font-600 accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">Aplicativo Emprime Recibo?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="font-500 panel-body">Sim, O sistema faz trabalho completo de emprimir recibo e ate enviar confirmação do pedido para o cliente.</div>
                                </div>
                            </div>
                            <!--End Accordian Single-->

                            <!--Start Accordian Single-->
                            <div class="panel panel-default wow fadeInUp" data-wow-delay="0.5s">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="font-600 accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">Vocês oferecem apoio?</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="font-500 panel-body">Sim! nosso negócio é fazer o seu negócio crescer! damos total apoio aos nosso clientes.</div>
                                </div>
                            </div>
                            
                            
                            <!--End Accordian Single-->
                        </div>
                    </div>
                    <!--End Faq Accordian-->

                    <!--Start Faq Image-->
                    <div class="col-md-6">
                        <div class="faq-img float-right wow fadeIn" data-wow-delay="0.2s">
                            <img src="assets_land/images/app8.png" class="img-responsive" alt="Image">
                        </div>
                    </div>
                    <!--End Faq Image-->
                </div>
                <!--Start Faq Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Faq Section-->

        
                        </div>
                        <!--End Testimonial Carousel-->
                    </div>
                </div>
                <!--End Testimonial Row-->
            </div>
            <!--End Container-->
        </section>
        <!--End Testimonial Section-->
	
        <!--Start Contact Section-->
        <section id="contact" class="bg-gray">
            <!--Start Container-->
            <div class="container">
                <!--Start Heading Row-->
                <div class="row">
                    <!--Start Heading Col-->
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <!--Start Heading-->
                        <div class="section-heading text-center">
                            <h2 class="font-700 color-base text-uppercase wow fadeInUp" data-wow-delay="0.1s">Entre em contato conosco</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Estamos esperando o seu contato, escolha um de nossos canais ou envie um <strong>WHATSAPP</strong></p>
                            <div class="about-btn btn-lg p-0 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="gradient-bg-1" href="https://linktr.ee/Anotar_Pedidos>" target="_blank"></i><span class="float-right text-center font-w-700"><strong>CONTATO</strong></a>
                        </div>
                        </div>
                        
                        
                        <!--End Heading-->
                    </div>
                    
                    <!--End Heading Col-->
                </div>
                
                <!--End Heading Row-->

                <!--Start Contact Info-->
                <div class="contact-info">
                    <!--Start Row-->
                    <div class="row">
                        <!--Start Contact Info Single-->
                        <div class="col-sm-3">
                            <div class="contact-info-single text-center wow fadeIn" data-wow-delay="0.1s">
                                <i class="icofont icofont-email gradient-bg-1 color-white"></i>
                                <p>anotarpedido@gmail.com</p>
                            </div>
                        </div>
                        <!--End Contact Info Single-->

                        <!--Start Contact Info Single-->
                        <div class="col-sm-3">
                            <div class="contact-info-single text-center wow fadeIn" data-wow-delay="0.2s">
                                <i class="icofont icofont-phone gradient-bg-1 color-white"></i>
                                <p>47992001527</p>
                            </div>
                        </div>
                        <!--End Contact Info Single-->

                        <!--Start Contact Info Single-->
                        <div class="col-sm-3">
                            <div class="contact-info-single text-center wow fadeIn" data-wow-delay="0.3s">
                                <i class="icofont icofont-social-google-map gradient-bg-1 color-white"></i>
                                <p>Joinville - SC</p>
                            </div>
                        </div>
                        <!--End Contact Info Single-->

                        <!--Start Contact Info Single-->
                        <div class="col-sm-3">
                            <div class="contact-info-single text-center wow fadeIn" data-wow-delay="0.4s">
                                <i class="icofont icofont-social-instagram gradient-bg-1 color-white"></i>
                                <p>@anotar_pedido</p>
                            </div>
                            
                        </div>
                        
                                    <?
                                    if (isset($_POST) and isset($_POST['action']) and $_POST['action'] == "send_message") {
                                        extract($_POST);
                                        if (!empty($name) and !empty($email) and !empty($subject) and !empty($message)) {
                                            require_once "_app/Config.inc.php";
                                            $to      = EMAIL_MSG;
                                            $subject = $subject;
                                            $message = 'Nome: '.$name. "\r\n" .$message;
                                            $headers = 'From: '.$email . "\r\n" .
                                                       'Reply-To: '.$email . "\r\n" .
                                                       'X-Mailer: PHP/' . phpversion();

                                            if (mail($to, $subject, $message, $headers)) {
                                                ?>
                                                <div class="alert alert-success" style="margin-top: 15px;">
                                                    <strong>Sucesso!</strong><span> Sua mensagem foi enviada com sucesso!</span>
                                                </div>
                                                <?
                                            }
                                            else {
                                                ?>
                                                <div class="alert alert-danger" style="margin-top: 15px;">
                                                    <strong>Erro!</strong><span> Falha ao enviar sua mensagem!</span>
                                                </div>
                                                <?
                                            }
                                        }
                                    }
                                    ?>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <!--End Contact Form-->

                        <!--Start Google Map-->
                                     
                        </div>
                        <!--End Google Map-->
                    </div>
                    <!--End Row-->
                </div>
                <!--End Contact Form Content-->
            </div>
            <!--End Container-->
        </section>
        <!--End Contact Section-->

        <!--Start Footer-->
        <footer id="footer">
            <!--Start Container-->
            <div class="container">
                <!--Start Row-->
                <div class="row">
                    <!--Start Footer Social-->
                    <div class="col-sm-4">
                        <div class="footer-social text-left wow fadeIn" data-wow-delay="0.1s">
                            <ul>
                                <li><a href="https://www.facebook.com/AnotarPedido"><i class="icofont icofont-social-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/anotar_pedido/"><i class="icofont icofont-social-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!--End Footer Social-->

                    <!--Start Copyright Text-->
                    <div class="col-sm-8">
                        <div class="copyright-text text-right wow fadeIn" data-wow-delay="0.2s">
                            <p class="color-white">&copy; 2021 Todos os direitos reservados <a class="color-base" href="#">Freeatom</a></p>
                        </div>
                    </div>
                    <!--End Copyright Text-->
                </div>
                <!--End Row-->
            </div>
            <!--End Container-->

            <!--Start ClickToTop-->
            <a href="https://linktr.ee/Anotar_Pedidos>"
    target="_blank"
    style="position:fixed;bottom:20px;right:30px;">
    <svg enable-background="new 0 0 512 512" width="50" height="50" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z" fill="#4CAF50"/><path d="m405.02 361.5c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.62-127.46-112.58-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016 0.16 8.576 0.288 7.52 0.32 11.296 0.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744s-7.36 7.68-11.136 12.352c-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z" fill="#FAFAFA"/></svg>
</a>
            <!--End ClickToTop-->
        </footer>
        <!--End Footer-->
    </div>
    <!--End Body Wrap-->

    <!--jQuery JS-->
    <script src="assets_land/js/jquery.min.js"></script>
    <!--Google Map API-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4yKUBz0tTKwfw8zY8mYOR7MAZy9coIMg&callback" async defer></script>
    <script src=""></script>
    <!--Counter JS-->
    <script src="assets_land/js/waypoints.js"></script>
    <script src="assets_land/js/jquery.counterup.min.js"></script>
    <!--Bootstrap JS-->
    <script src="assets_land/js/bootstrap.min.js"></script>
    <!--Magnic PopUp JS-->
    <script src="assets_land/js/magnific-popup.min.js"></script>
    <!--Owl Carousel JS-->
    <script src="assets_land/js/owl.carousel.min.js"></script>
    <!--Wow JS-->
    <script src="assets_land/js/wow.min.js"></script>
    <!--Bootsnavs JS-->
    <script src="assets_land/js/bootsnav.js"></script>
    <!--Contact Form JS-->
    <script src="mailer_land/ajax-contact-form.js"></script>
    <!--Main-->
    <script src="assets_land/js/custom.js"></script>

</body>

</html>