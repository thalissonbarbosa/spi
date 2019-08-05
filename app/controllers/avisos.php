<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

class Avisos extends Base\Controller
{

    public function Index()
    {
        $viewmodel = new Models\Avisos();
        $this->returnView($viewmodel->Index(), true);
    }

}
