<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

/**
 * Description of log
 *
 * @author Thalisson
 */
class Logs extends Base\Controller
{

    public function Index()
    {
        $viewmodel = new Models\Logs();
        $this->returnView($viewmodel->Index(), true);
    }
    public function Limpar()
    {
        $function = new Models\Logs();
        return $function->delete();
    }

}
