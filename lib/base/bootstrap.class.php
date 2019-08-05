<?php

namespace Lib\Base;

use Lib\Classes as Classes;

/**
 * Description of Bootstrap
 *
 * @author Thalisson
 */
class Bootstrap
{

    private $controller;
    private $action;
    private $request;
    public static $background;

    public function __construct($request)
    {

        $this->request = $request;

        if ($this->request['controller'] == ""):
            $this->controller = 'App\\Controllers\\' . 'home';
        else:
            $this->controller = 'App\\Controllers\\' . $this->request['controller'];
        endif;

        if ($this->request['action'] == ""):
            $this->action = "index";
        else:
            $this->action = $this->request['action'];
        endif;
    }

    public function createController()
    {
        // Checando a classe
        if (class_exists($this->controller)):

            $parents = class_parents($this->controller);

            // Checando extend
            if (in_array('Lib\\Base\\' . "Controller", $parents)):

                if (method_exists($this->controller, $this->action)):
                    return new $this->controller($this->action, $this->request);
                else:
                    header('Location: ' . URL_ROOT . 'error/?t=404');
                    // Método não existe
                    Classes\Messages::setMsg("Método não existe", 'error');
                    Classes\Messages::getMsg();
                    return;
                endif;
            else:
                header('Location: ' . URL_ROOT . 'error/?t=404');
                // Base Controller não existe
                Classes\Messages::setMsg("Base Controller não existe", 'error');
                Classes\Messages::getMsg();
                return;
            endif;
        else:
            header('Location: ' . URL_ROOT . 'error/?t=404');
            // Controller Class não existe
            Classes\Messages::setMsg("Class Controller não existe", 'error');
            Classes\Messages::getMsg();
            return;
        endif;
    }

    public function getController()
    {

        return $this->parse_classname($this->controller);
    }

    public function getAction()
    {
        return $this->action;
    }

    public function parse_classname($name)
    {
        return join('', array_slice(explode('\\', $name), -1));
        /*
          return array(
          'namespace' => array_slice(explode('\\', $name), 0, -1),
          'classname' => join('', array_slice(explode('\\', $name), -1)),
          );
         */
    }

}
