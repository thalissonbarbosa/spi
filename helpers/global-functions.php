<?php

// Função para converter primeira letra de cada palavra
function mb_ucwords($str)
{
    $str_return = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    return ($str_return);
}

// Função para converter a primeira letra da frase
function mb_ucfirst($str)
{
    $str_return = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
    $str_return = ucfirst($str_return);
    return ($str_return);
}

// Função para diminuir todos os caracteres
function mb_tolower($str)
{
    $str_return = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
    return ($str_return);
}

// Função para formatar a Data no modelo 00/00/000
function dformat($str)
{
    $date = explode("-", $str);
    return $date[2] . "/" . $date[1] . "/" . $date[0];
}

// Função para formatar a Data no modelo 00-00-000
function dFormatDB($str)
{
    $data = explode("/", $str);
    return $data[2] . "-" . $data[1] . "-" . $data[0];
}

// Função para formatar a Hora no modelo 00:00
function hformat($str)
{
    $hora = explode(':', $str);
    return $hora[0] . ":" . $hora[1];
}

// Função para formatar o Valor para modelo do DB
function nFormatDB($str)
{
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $str);
    return $valor;
}

// Função para formatar o Valor retornado do banco
function nformat($str)
{
    $valor = number_format($str, 2, ',', '.');
    return $valor;
}

// Pegar $_GET int protegido
function _GetInt($value)
{

    if (isset($_GET[$value])):
        if ($_GET[$value] == null):
            exit();
        elseif ((int) $_GET[$value] == 0):
            Lib\Classes\Messages::setMsg('Não foi possível exibir o conteúdo.', 'error');
            Lib\Classes\Messages::getMsg();
            return exit();
        else:
            return (int) $_GET[$value];
        endif;
    endif;
}

// Pegar $_GET string protegido
function _GetString($value)
{

    if (isset($_GET[$value])):
        if ($_GET[$value] == null):
            exit();
        else:
            return $_GET[$value];
        endif;
    endif;
}

// Arredondar sempre para cima

function round_up($number, $precision = 2)
{
    $fig = (int) str_pad('1', $precision, '0');
    return (ceil($number * $fig) / $fig);
}
