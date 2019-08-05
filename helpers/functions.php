<?php

use Lib\Base as Base;
use Lib\Classes as Classes;

function breadcrumbsLTE()
{
    $bootstrap = new Lib\Base\Bootstrap($_GET);
    $controller = mb_ucwords($bootstrap->getController());
    $action = mb_ucwords($bootstrap->getAction());
    $prmt = mb_ucwords($_GET['id']);

    if ($action == "Index"):
        $action = "Principal";
    endif;
    ?>
    <li><a href="<?= URL_ROOT; ?>">Início</a></li>
    <?php
    if ($controller != "Home"):

        echo "<li><a href='" . URL_ROOT . strtolower($controller) . "'>{$controller}</a></li>";

    endif;

    if ($prmt == '' || (int) $prmt != 0):
        echo "<li class='active'>{$action}</li>";
    else:

        echo "<li><a href='" . URL_ROOT . mb_tolower($controller) . "/" . mb_tolower($action) . "'>{$action}</a></li>";
        echo "<li class='active'>{$prmt}</li>";

    endif;
}

// Exibir data Atual
function getDataExtensa()
{

    $dayName = array("Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado");
    $monName = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

    echo $dayName[date('w')] . ", " . date('j') . " de " . $monName[date('n') - 1] . " de " . date('Y');
    echo "<br />";
}

// Verifica permissão -> acessa class Permissoes.class
function permissao($permissao, $id = null, $redirect = false)
{
    $Permissao = new Classes\Permissoes();
    return $Permissao->permissao($permissao, $id, $redirect);
}

// LISTAS
/*
 * @table   -> tabela a procurar        NOT NULL
 * @option  -> opção a exibir no option NOT NULL
 * @value   -> value do option          NULL = id
 * @select  -> se está selecionado      NULL
 * @order   -> order by da consulta     NULL = ORDER BY id DESC
 * @where   -> where da consulta        NULL
 */
function listaOption($table, $option, $value, $select, $order, $where)
{
    $Listas = new Classes\Listas();
    return $Listas->listaOption($table, $option, $value, $select, $order, $where);
}
