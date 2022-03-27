<?php require 'funcoes.php';
require 'Conn/Conn.class.php';

/*
if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost')) {
    //CONFIGRAÇÕES DO BANCO DE DADOS
    define('HOST', 'mysql.docker.local');
    define('USER', 'root');
    define('PASS', '123');
    define('DBSA', 'anotar08_banco');
} else {
    // CONFIGRAÇÕES DO BANCO DE DADOS ####################
    define('HOST', 'localhost');
    define('USER', 'anotar08_marcos');
    define('PASS', '34222449MA??');
    define('DBSA', 'anotar08_banco');

    // DEFINE A BASE DO SITE ####################
    define('HOME', 'https://anotarpedido.com.br/');
}*/

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'anotar1');
define('HOME', 'https://localhost/anotarpedidos/');

define("GOOGLE_MAPS_API_KEY", "AIzaSyCi4DJnXuAZIYYgtzgh5AhKk6dzWszliG4");
define("EMAIL_MSG","contatofreeatom@gmail.com"); //Email para recebimento e envio de mensagens
define("PHONE_NUMBER","47992001527"); //Telefone para chamarem no whats

//DEFINE HTACCESS PARA URLS AMIGÁVEIS
if(!is_null(INPUT_GET) && !is_null(FILTER_DEFAULT)) {
    $urlFiltered = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

    if(!is_null($urlFiltered)) {
        $getUrl = strip_tags(trim($urlFiltered));
    }
}
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url    = explode('/', $setUrl);

// AUTO LOAD DE CLASSES ####################
// function __autoload($Class) {

//     $cDir = ['Conn', 'Helpers', 'Models'];
//     $iDir = null;

//     foreach ($cDir as $dirName) :
//         if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')) :
//             include_once(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
//             $iDir = true;
//         endif;
//     endforeach;

//     if (!$iDir) :
//         trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
//         die;
//     endif;
// }
// TRATAMENTO TELEFONE #####################
function formatPhone($phone)
{
    $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
    $matches = [];
    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
    if ($matches) {
        return '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
    }

    return $phone; // Retornao numero formatado
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie) :
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR) :
        die;
    endif;
}

set_error_handler('PHPErro');

//require('Library/PHPMailer/PHPMailerAutoload.php');
require 'textos.config.php';
require("Conn/Create.class.php");
require("Conn/Delete.class.php");
require("Conn/Read.class.php");
require("Conn/Update.class.php");

$lerbanco    = new Read();
$updatebanco = new Update();
$addbanco    = new Create();
$deletbanco  = new Delete(); 

$lerbanco->ExeRead("configuracoes_site");
if ($lerbanco->getResult()) :
    $getEmpresa = $lerbanco->getResult();
endif;