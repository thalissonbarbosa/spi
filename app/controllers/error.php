<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;
/**
 * Description of agendamento
 *
 * @author Thalisson
 */
class Error extends Base\Controller
{
    /*
     * PAGES
     */

    public function Index()
    {
        $viewmodel = new Models\Error();
        $this->returnView($viewmodel->Index(), true);
    }
}
