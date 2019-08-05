<?php

namespace Lib\Classes;

/**
 * Sessão de Login
 *
 * @author Thalisson Barbosa
 */
class Sessao
{
    /*
     * Armazena os dados da sessão
     * 
     * @var Array
     */

    private $Session = array();

    /*
     * Iniciando Sessão
     * 
     * Coloca dados da sessão no array $_SESSION['user']
     * 
     */

    public function iniciarSessao($User_id, $Nome, $Login, $Tipo)
    {

        $this->Session['sessao_id'] = session_id();
        $this->Session['id'] = $User_id;
        $this->Session['nome'] = $Nome;
        $this->Session['login'] = $Login;
        $this->Session['tipo'] = $Tipo;
        $this->Session['autenticado'] = true;
        $this->Session['tempo_on'] = time();
        $this->Session['tempo_end'] = time() + 1800; // <- Segundos
        $this->Session['ip'] = $_SERVER['REMOTE_ADDR'];

        $_SESSION['user'] = $this->Session;

        // Inserindo LOG
        $Log = new \Lib\Classes\Log();
        $Log->sistema_log('Fez Login', $_SESSION['user']['nome']);
    }

    /*
     * Verifica se a sessão vai expirar
     * 
     * Renova sessão ou Desconecta
     */

    public static function expiraSessao()
    {

        // Pegando tempo atual (segundos)
        $tempoAgora = time();
        // Diminuindo o tempo atual para saber se expirou (< 0)
        $tempoRestante = $_SESSION['user']['tempo_end'] - $tempoAgora;

        // Verificando se expirou
        if ($tempoRestante <= 0):

            // Inserindo LOG
            $Log = new \Lib\Classes\Log();
            $Log->sistema_log('Foi desconectado por inatividade', $_SESSION['user']['nome']);
            // Desconectando sessão
            $this->encerrarSessao();
        else:

            // Renova o tempo de sessão
            $_SESSION['user']['tempo_end'] = time() + 1800; // <- Segundos
        endif;

        // Aproximando valor e transformando em minuto
        return round($tempoRestante / 60); // Minutos
        //$this->TempoRestante = round($tempoRestante); // Segundos
    }

    /*
     * Verifica se a sessão está ativa
     * 
     * Presente em todas a páginas exceto as de Login
     */

    public function verificaSessao()
    {
        $bootstrap = new \Lib\Base\Bootstrap($_GET);
        
        // paginas para nao verificar sessao
        $actions = array(
            'login',
            'logar',
            'recuperar_senha',
            'recuperarSenha',
            'redefinir',
            'redefinirSenha',
        );
        $controllers = array(
            'pdf'
        );
        
        $verifica = true;
        
        // verificando paginas com permissao      
        foreach ($actions as $value):
            if ($bootstrap->getAction() == $value):
                $verifica = false;
            endif;
        endforeach;
        
        foreach ($controllers as $value):
            if ($bootstrap->getController() == $value):
                $verifica = false;
            endif;
        endforeach;
        
        if ($verifica):

            if (!isset($_SESSION['user']["autenticado"])):

                header('location: ' . URL_ROOT . 'usuario/login');
                exit();

            endif;

        endif;
    }

    /*
     * Encerrando a Sessão
     * 
     * unset no array ['user']
     */

    public function encerrarSessao()
    {

        // Inserindo LOG
        $Log = new \Lib\Classes\Log();
        $Log->sistema_log('Fez Logout', $_SESSION['user']['nome']);

        unset($_SESSION['user']);
        session_destroy();
        $location = URL_ROOT . "usuario/login";
        header("location: " . $location);
        exit();
    }

}
