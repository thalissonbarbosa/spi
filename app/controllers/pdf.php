<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

/**
 * Description of log
 *
 * @author Thalisson
 */
class Pdf extends Base\Controller
{

    public function Index()
    {
        $viewmodel = new Models\Pdf();
        $this->returnView($viewmodel->Index(), true);
    }
    
    public function Load()
    {
        $viewmodel = new Models\Pdf();
        $this->returnView($viewmodel->Index(), false);
    }
    
    public function Output()
    {
        $viewmodel = new Models\Pdf();
        $this->returnView($viewmodel->Index(), false);
    }

}
