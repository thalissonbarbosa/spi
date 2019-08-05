<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

/**
 * Description of agendamento
 *
 * @author Thalisson
 */
class Agendamento extends Base\Controller
{
    /*
     * PAGES
     */

    public function Index()
    {
        $viewmodel = new Models\Agendamento();
        $this->returnView($viewmodel->Index(), true);
    }

    public function Visitas()
    {
        return $this->Index();
    }

    public function Servicos()
    {
        return $this->Index();
    }

    public function Cadastrar()
    {
        return $this->Index();
    }

    /*
     * Visitas CRUD
     */

    public function insertVisita()
    {
        $function = new Models\Agendamento\Visitas_DAO();
        return $function->insert();
    }

    public function updateVisita()
    {
        $function = new Models\Agendamento\Visitas_DAO();
        return $function->update();
    }

    public function deleteVisita()
    {
        $function = new Models\Agendamento\Visitas_DAO();
        return $function->delete();
    }

    public function searchVisita()
    {
        $function = new Models\Agendamento\Visitas_DAO();
        return $function->search();
    }

    /*
     * Serviços CRUD
     */

    public function insertServico()
    {
        $function = new Models\Agendamento\Servicos_DAO();
        return $function->insert();
    }

    public function updateServico()
    {
        $function = new Models\Agendamento\Servicos_DAO();
        return $function->update();
    }

    public function deleteServico()
    {
        $function = new Models\Agendamento\Servicos_DAO();
        return $function->delete();
    }

    public function searchServico()
    {
        $function = new Models\Agendamento\Servicos_DAO();
        return $function->search();
    }

}
