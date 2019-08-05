<?php

namespace App\Models;

use Lib\Base as Base;
use Lib\Classes as Classes;
use App\Models\Config as Config;

class Usuario extends Base\Model
{

    private $ResultQuery;

    /*
     * Dados do Usuário
     */
    private $Nome;
    private $Tipo;
    private $UserId;
    private $Hash;
    private $Login;
    private $Senha;

    public function Index()
    {
        return;
    }

    /*
     * Faz login
     */
    public function logar()
    {

        $this->Login = Classes\FiltroInput::login($_POST['login'], "Login"); //($_POST['login']);
        $this->Senha = Classes\FiltroInput::senha($_POST['senha'], "Login"); //($_POST['senha']);
        // Verificando se contém errors
        new Classes\FiltroInput();

        // Query a ser executada
        $query = "SELECT * FROM usuarios WHERE login = :login";


        // Executando a query
        $this->query($query);
        $this->bind(":login", $this->Login);
        $this->execute();
        $this->ResultQuery = $this->result();

        if ($this->ResultQuery):

            $this->Nome = $this->ResultQuery['nome'];
            $this->dadosUsuario();
            $this->verificaSenha();

        else:
            Classes\Messages::setMsg("Login não encontrado", 'error');
            return Classes\Messages::getMsg();

        endif;
    }

    /*
     * Pegando dados do usuário no banco para o login
     */

    private function dadosUsuario()
    {

        $user = $this->ResultQuery;

        $this->Nome = mb_ucwords($user['nome']);
        $this->Hash = $user['senha']; // Senha do Usuário
        $this->Tipo = mb_tolower($user['tipo']);
        $this->UserId = $user['id'];
    }

    /*
     * Verificando a senha do usuário
     * Usando Bcrypt
     */

    private function verificaSenha()
    {

        if (Classes\Bcrypt::check($this->Senha, $this->Hash)):

            // Iniciando sessão
            $sessao = new Classes\Sessao();
            $sessao->iniciarSessao($this->UserId, $this->Nome, $this->Login, $this->Tipo);

        else:
            Classes\Messages::setMsg("Senha incorreta", 'error');
            return Classes\Messages::getMsg();

        endif;
    }

    /*
     * Logout do sistema
     * Encerra a sessão $_SESSION['user]
     */

    public function logout()
    {

        $sessao = new Classes\Sessao();
        $sessao->encerrarSessao();
    }

    /*
     * Update Perfil
     * Atualiza os dados do perfil (usuario mode)
     */

    public function update()
    {
        $id = (int) $_POST['id'];
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $login = Classes\FiltroInput::input($_POST['login'], 'Login');
        Classes\FiltroInput::campoVazio($login, 'Login');
        $email = Classes\FiltroInput::email($_POST['email']);
        Classes\FiltroInput::campoVazio($email, 'Email');
        $senha_atual = Classes\FiltroInput::senha($_POST['senha_atual']);
        Classes\FiltroInput::campoVazio($senha_atual, 'Senha atual');
        $senha1 = $_POST['nova_senha'];
        $senha2 = $_POST['nova_senha2'];

        // Verificando se o usuário deseja atualizar senha
        if (empty($senha1) && empty($senha2)):
            $update_senha = "";
        else:
            $senha1 = Classes\FiltroInput::senha($senha1);
            // Verificando se as senhas são iguais
            if ($senha1 != $senha2):
                array_push(Classes\FiltroInput::$Errors, "► Senhas não correspondem!<br />");
            else:
                $senha = Classes\Bcrypt::hash($senha1);
                $update_senha = ", senha = :senha";
            endif;
        endif;

        // verificando errors
        new Classes\FiltroInput();

        // buscando usuarios cadastrados
        $Usuarios = new Config\Usuarios_DAO();

        $search = $Usuarios->getList("WHERE login = '{$login}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, " ► Este login já existe. Por favor insira outro.<br />");
        endif;

        $search = $Usuarios->getList("WHERE email = '{$email}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, " ► Este e-mail já existe. Por favor insira outro.<br />");
        endif;

        // Checando a senha Atual
        $search = $Usuarios->getList("WHERE login = '{$login}' AND email = '{$email}'");

        if (count($search) != 0):
            if (Classes\Bcrypt::check($senha_atual, $search[0]['senha'])):

            else:
                array_push(Classes\FiltroInput::$Errors, " ► Sua senha atual está incorreta.<br />");
            endif;

        endif;

        // verificando errors
        new Classes\FiltroInput();


        $query = "UPDATE usuarios SET nome = :nome, login = :login, email = :email {$update_senha} WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':nome', $nome);
        ($update_senha != '') ? $this->bind(':senha', $senha) : '';
        $this->bind(':login', $login);
        $this->bind(':email', $email);

        if ($this->execute()):
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou seu perfil ($login)");
        endif;
    }

    /*
     * Recuperar Senha
     * Manda email para o usuario com instruções
     * @Return false or error
     */

    public function recuperarSenha()
    {
        // pegando email dado no formulario
        $email = Classes\FiltroInput::email($_POST['email']);

        // verificando se o email existe no banco
        $this->query("SELECT * FROM usuarios WHERE email = :email");
        $this->bind(':email', $email);
        $this->execute();
        $result = $this->result();

        if ($result == false):
            Classes\Messages::setMsg('Email não encontrado.', 'error');
            Classes\Messages::getMsg();
            exit();
        endif;

        // id do usuario
        $usuario_id = $result['id'];
        // nome do usuario
        $usuario_nome = mb_ucwords($result['nome']);

        // gerando string aleatória
        $randomString = substr("abcdefghijklmnopqrstuvwxyz", mt_rand(0, 15), 1) . substr(md5(time()), 1);

        // gerando token
        $token = Classes\Bcrypt::hash($randomString);

        // tempo para expirar o token - hoje + 2 horas
        $expires = date("Y-m-d H:i:s", strtotime('+2 hours'));

        // inserindo no banco
        $query = "INSERT INTO usuarios_tokens (usuarios_id, token, validate)"
                . "VALUES (:usuario_id, :token, :expires)";
        $this->query($query);
        $this->bind(':usuario_id', $usuario_id);
        $this->bind(':token', $token);
        $this->bind(':expires', $expires);
        $this->execute();

        // link para recuperar senha
        $link = URL_ROOT . "usuario/redefinir?token={$token}&id={$usuario_id}";
        // conteudo do email

        $conteudo = "Olá <strong> $usuario_nome</strong>! <br /><br />";

        $conteudo .= "Foi solicitado a recuperação de sua senha SPI Cabral Gama.<br /><br />";

        $conteudo .= "Seu link para redefinir sua senha é:<br />";
        $conteudo .= "<a href='{$link}' target='_blank'>{$link}</a><br /><br />";

        $conteudo .= "Este link tem validade de 2 horas.<br />";
        $conteudo .= "Se você não solicitou a redefinição de senha, ignore esta mensagem; provavelmente alguém escreveu seu e-mail por acaso.<br /><br />";

        $conteudo .= "Atenciosamente, <br /><br />";
        $conteudo .= "Suporte SPI Cabral Gama";

        $mail = new Classes\Mail();

        $mail->sendEmail($email, "Redefinição de senha - SPICG", $conteudo);
    }

    /*
     * Redefinir Senha
     * @Return false or error
     */
    public function redefinirSenha()
    {
        $id = (int) $_POST['id'];
        $senha = Classes\FiltroInput::senha($_POST['senha']);
        $senha2 = $_POST['senha2'];

        // Verificando se as senhas são iguais
        if ($senha != $senha2):
            array_push(Classes\FiltroInput::$Errors, "► As senhas que você digitou não são iguais!<br />");
        else:
            $senha_crypt = Classes\Bcrypt::hash($senha);
        endif;

        // verificando errors
        new Classes\FiltroInput();

        $query = "UPDATE usuarios SET senha = :senha WHERE id = :id";
        $this->query($query);
        $this->bind(':senha', $senha_crypt);
        $this->bind(':id', $id);
        
        if ($this->execute()):
            
            $this->query("DELETE FROM usuarios_tokens WHERE usuarios_id = :id");
            $this->bind(':id', $id);
            $this->execute();
            
            return false;
                    
        endif;
    }

    /*
     * Verificar Token
     * Verifica se há token do usuario no banco
     * e se está válido
     */
    public function verificaToken($token, $usuario_id)
    {
        $query = "SELECT token FROM usuarios_tokens WHERE token = :token AND usuarios_id = :id AND validate > NOW()";
        $this->query($query);
        $this->bind(':token', $token);
        $this->bind(':id', $usuario_id);
        $this->execute();

        return $this->result();
    }

}
