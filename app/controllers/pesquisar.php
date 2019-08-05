<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

/**
 * Description of pesquisar
 *
 * @author Thalisson
 */
class Pesquisar extends Base\Controller
{
    public function index(){
        $viewmodel = new Models\Pesquisar();
        $this->returnView($viewmodel->index(), true);
    }
    
    public function search()
    {
        $function = new Models\Pesquisar();
        return $function->search();
    }
}
