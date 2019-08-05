<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

class Home extends Base\Controller
{

    protected function Index()
    {

        $viewmodel = new Models\Home();
        $this->returnView($viewmodel->Index(), true);
    }

}
