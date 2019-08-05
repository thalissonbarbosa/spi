<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;
/**
 * Description of atendimento
 *
 * @author Thalisson
 */
class Atendimento extends Base\Controller
{

    public function Index()
    {
        $viewmodel = new Models\Atendimento();
        $this->returnView($viewmodel->Index(), true);
    }

    public function Detalhes()
    {
        $viewmodel = new Models\Atendimento();
        $this->returnView($viewmodel->Index(), true);
    }

    public function Editar()
    {
        $viewmodel = new Models\Atendimento();
        $this->returnView($viewmodel->Index(), true);
    }

    // FUNCTIONS
    
    public function cadastrar()
    {

        $viewmodel = new Models\Atendimento();
        return $viewmodel->insert();
    }

    public function edit()
    {
        $viewmodel = new Models\Atendimento();
        return $viewmodel->update();
    }

    public function excluir()
    {
        $viewmodel = new Models\Atendimento();
        return $viewmodel->delete();
    }

    public function busca()
    {
        $viewmodel = new Models\Atendimento();
        return $viewmodel->search();
    }

}
