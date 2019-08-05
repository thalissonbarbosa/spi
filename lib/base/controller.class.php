<?php

namespace Lib\Base;

abstract class Controller
{

    protected $request;
    protected $action;
    protected $layout;

    public function __construct($action, $request)
    {
        $this->action = $action;
        $this->request = $request;
    }

    public function executeAction()
    {
        return $this->{$this->action}();
    }

    protected function returnView($viewmodel, $fullview)
    {
        $this->setLayout(LAYOUT_NAME);

        $Bootstrap = new Bootstrap($_GET);
        $className = $Bootstrap->parse_classname(get_class($this));
        $view = 'app/views/' . $this->layout . '/pages/' . strtolower($className) . '/' . $this->action . '.php';

        if ($fullview):
            require('app/views/' . $this->layout . '/main.php');
        else:
            require($view);
        endif;
    }

    protected function setLayout($name)
    {
        $this->layout = $name;
    }

}
