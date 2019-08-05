<?php

namespace App\Models;

use Lib\Base as Base;

class Home extends Base\Model
{

    public function Index()
    {
        return;
    }
   

    public function imoveisRecentes($limite)
    {
        $query = "SELECT * FROM vw_imoveis ORDER BY id DESC LIMIT :limite ";
        $this->query($query);
        $this->bind(":limite", $limite);
        $this->execute();
        return $this->resultSet();

    }

    /*
     * @return array de Visitas e Servicos
     */

    public function avisos($limite)
    {

        // Buscando visitas
        $query = "SELECT * FROM ag_visitas "
                . "WHERE (dataVisita BETWEEN CURDATE() AND CURDATE() + INTERVAL 5 DAY) "
                . "AND CASE WHEN dataVisita = CURDATE() THEN hora >= CURTIME() ELSE TRUE END "
                . "AND status = 'pendente' "
                . "ORDER BY dataVisita, hora ASC LIMIT :limite";
        $this->query($query);
        $this->bind(":limite", $limite);
        $this->execute();
        $visita = $this->resultSet();


        // Buscando serviços
        $query = "SELECT * FROM vw_servicos "
                . "WHERE (dataServico BETWEEN CURDATE() AND CURDATE() + INTERVAL 5 DAY) "
                . "AND CASE WHEN dataServico = CURDATE() THEN hora >= CURTIME() ELSE TRUE END "
                . "AND status = 'pendente' "
                . "ORDER BY dataServico ASC LIMIT :limite";
        $this->query($query);
        $this->bind(":limite", $limite);
        $this->execute();
        $servico = $this->resultSet();

        return array(
            'visita' => $visita,
            'servico' => $servico
        );
    }

}
