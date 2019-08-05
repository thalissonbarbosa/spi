<?php

namespace Lib\Classes;

use Lib\Base as Base;

/**
 * Description of Messages
 *
 * @author Thalisson
 */
class Messages extends Base\Model
{

    public static function setMsg($text, $type)
    {

        if ($type == 'error'):
            $_SESSION['errorMsg'] = $text;
        else:
            $_SESSION['successMsg'] = $text;
        endif;
    }

    public static function getMsg()
    {

        if (isset($_SESSION['errorMsg'])):
            echo
            '<div class="alert alert-danger alert-dismissable">'
            . '<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>'
            . $_SESSION['errorMsg']
            . "</div>";
            unset($_SESSION['errorMsg']);
        endif;

        if (isset($_SESSION['successMsg'])):
            echo 
            '<div class="alert alert-success alert-dismissable">'
            . '<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>'
            . '<h4><i class="icon fa fa-check"></i>Sucesso!</h4>'
            . $_SESSION['successMsg'] 
            . "</div>";
            unset($_SESSION['successMsg']);
        endif;
    }

    public function alertas()
    {

        $queryVisitas = "SELECT * FROM ag_visitas "
                . "WHERE (dataVisita BETWEEN CURDATE() AND CURDATE() + INTERVAL 5 DAY) "
                . "AND CASE WHEN dataVisita = CURDATE() THEN hora >= CURTIME() ELSE TRUE END "
                . "AND status = 'pendente' "
                . "ORDER BY dataVisita, hora ASC";
        $queryServicos = "SELECT * FROM vw_servicos "
                . "WHERE (dataServico BETWEEN CURDATE() AND CURDATE() + INTERVAL 5 DAY) "
                . "AND CASE WHEN dataServico = CURDATE() THEN hora >= CURTIME() ELSE TRUE END "
                . "AND status = 'pendente' "
                . "ORDER BY dataServico ASC";

        $this->query($queryVisitas);
        $this->execute();
        $rowsVisitas = $this->numRows();
        $this->query($queryServicos);
        $this->execute();
        $rowsServicos = $this->numRows();

        $alertas = $rowsVisitas + $rowsServicos;

        echo $alertas;
    }

}
