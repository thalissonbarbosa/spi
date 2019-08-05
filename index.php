<?php
// Iniciando sessao
session_start();

// include Config
require('config.php');
// Incluindo arquivo de funções globais
require('helpers/global-functions.php');
require('helpers/functions.php');
require('vendor/autoload.php');

require('lib/classes/AutoLoad.class.php');

// AutoLoad
$autoLoad = new AutoLoad();
$autoLoad->setPath(ROOT);
$autoLoad->setExt('php');

spl_autoload_register(array($autoLoad, 'loadClasses'));
spl_autoload_register(array($autoLoad, 'loadModel'));
spl_autoload_register(array($autoLoad, 'loadController'));
 

// Verificando se está logado / sessão ativa
$sessao = new Lib\Classes\Sessao();
$sessao->verificaSessao();


$bootstrap = new Lib\Base\Bootstrap($_GET);
$controller = $bootstrap->createController();

if($controller){
    $controller->executeAction();
}

