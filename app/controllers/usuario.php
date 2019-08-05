<?php

namespace App\Controllers;

use Lib\Base as Base;
use App\Models as Models;

class Usuario extends Base\Controller
{

    /*
     * Index
     */
    protected function Index()
    {
        $viewmodel = new Models\Usuario();
        $this->returnView($viewmodel->Index(), true);
    }

    /*
     * Página de Login
     */
    protected function Login()
    {
        $viewmodel = new Models\Usuario();
        $this->returnView($viewmodel->Index(), false);
    }
    
    /*
     * Página de Solicitar Redefinição
     */
    protected function Recuperar_Senha()
    {
        $viewmodel = new Models\Usuario();
        $this->returnView($viewmodel->Index(), false);
    }
    
    /*
     * Página de Redefinir Senha
     */
    protected function Redefinir()
    {
        $viewmodel = new Models\Usuario();
        $this->returnView($viewmodel->Index(), false);
    }

    /*
     * Logar no sistema
     */
    protected function logar()
    {
        $viewmodel = new Models\Usuario();
        return $viewmodel->logar();
    }

    /*
     * Sair do sistema
     */
    protected function logout()
    {
        $viewmodel = new Models\Usuario();
        return $viewmodel->logout();
    }
    
    /*
     * Atualizar perfil
     */
    public function update()
    {
        $function = new Models\Usuario();
        return $function->update();
    }
    
    /*
     * Solicitar redefinição de senha
     */
    public function recuperarSenha()
    {
        $function = new Models\Usuario();
        return $function->recuperarSenha();
    }
    
    /*
     * Redefinir Senha
     */
    public function redefinirSenha()
    {
        $function = new Models\Usuario();
        return $function->redefinirSenha();
    }

}
