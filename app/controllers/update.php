<?php

namespace App\Controllers;

use Lib\Base as Base;

class Update extends Base\Controller
{

    protected function Index()
    {
        $viewmodel = new \App\Models\Update();
        $this->returnView($viewmodel->Index(), true);
    }
    

}
