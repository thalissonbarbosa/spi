<?php

namespace App\Controllers;

use Lib\Base as Base;

class Documentacao extends Base\Controller
{
    public function Index()
    {
        $this->returnView(true, false);
    }
}
