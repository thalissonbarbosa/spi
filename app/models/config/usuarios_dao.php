<?php

namespace App\Models\Config;

use Lib\Base as Base;
use Lib\Classes as Classes;
use Lib\Interfaces as Interfaces;

/**
 * Description of usuarios_DAO
 *
 * @author Thalisson
 */
class Usuarios_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $login = Classes\FiltroInput::input($_POST['login'], 'Login');
        Classes\FiltroInput::campoVazio($login, 'Login');
        $email = Classes\FiltroInput::email($_POST['email']);
        Classes\FiltroInput::campoVazio($email, 'Email');
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Tipo');
        Classes\FiltroInput::campoVazio($tipo, 'Tipo');

        $senha1 = Classes\FiltroInput::senha($_POST['senha1']);
        $senha2 = $_POST['senha2'];

        // verificando errors
        new Classes\FiltroInput();

        // Verificando se as senhas são iguais
        if ($senha1 != $senha2):
            array_push(Classes\FiltroInput::$Errors, "► Senhas não correspondem!<br />");
        else:
            $senha = Classes\Bcrypt::hash($senha1);
        endif;

        // buscando usuarios cadastrados
        $search = $this->getList("WHERE login = '{$login}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, " ► Este login já existe. Por favor insira outro.<br />");
        endif;

        $search = $this->getList("WHERE email = '{$email}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, " ► Este e-mail já existe. Por favor insira outro.<br />");
        endif;

        // verificando errors
        new Classes\FiltroInput();


        $query = "INSERT INTO usuarios(nome,tipo,login,email,senha) values (:nome, :tipo , :login, :email , :senha)";
        $this->query($query);
        $this->bind(':nome', $nome);
        $this->bind(':tipo', $tipo);
        $this->bind(':login', $login);
        $this->bind(':email', $email);
        $this->bind(':senha', $senha);

        if ($this->execute()):
            // Id do usuario cadastrado
            $id_usuario = $this->lastInsertId();

            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Usuário ($login)");

            // Inserindo permissões
            $Permissoes = new Classes\Permissoes();
            $permissoes = $Permissoes->addPermissao($id_usuario, $tipo);
            $this->query($permissoes);
            $this->execute();

        endif;
    }

    public function update()
    {
        $id = (int) $_POST['id'];

        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $login = Classes\FiltroInput::login($_POST['login'], 'Login');
        Classes\FiltroInput::campoVazio($login, 'login');
        $email = Classes\FiltroInput::email($_POST['email']);
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Tipo');

        $imovel_cad = (isset($_POST['imovel_cad'])) ? 1 : 0;
        $imovel_edit = (isset($_POST['imovel_edit'])) ? 1 : 0;
        $imovel_del = (isset($_POST['imovel_del'])) ? 1 : 0;
        $fiador_cad = (isset($_POST['fiador_cad'])) ? 1 : 0;
        $fiador_edit = (isset($_POST['fiador_edit'])) ? 1 : 0;
        $fiador_del = (isset($_POST['fiador_del'])) ? 1 : 0;
        $locatario_cad = (isset($_POST['locatario_cad'])) ? 1 : 0;
        $locatario_edit = (isset($_POST['locatario_edit'])) ? 1 : 0;
        $locatario_del = (isset($_POST['locatario_del'])) ? 1 : 0;
        $proprietario_cad = (isset($_POST['proprietario_cad'])) ? 1 : 0;
        $proprietario_edit = (isset($_POST['proprietario_edit'])) ? 1 : 0;
        $proprietario_del = (isset($_POST['proprietario_del'])) ? 1 : 0;
        $visita_cad = (isset($_POST['visita_cad'])) ? 1 : 0;
        $visita_edit = (isset($_POST['visita_edit'])) ? 1 : 0;
        $visita_del = (isset($_POST['visita_del'])) ? 1 : 0;
        $servicos_cad = (isset($_POST['servicos_cad'])) ? 1 : 0;
        $servicos_edit = (isset($_POST['servicos_edit'])) ? 1 : 0;
        $servicos_del = (isset($_POST['servicos_del'])) ? 1 : 0;
        $atendimento_edit = (isset($_POST['atendimento_edit'])) ? 1 : 0;
        $atendimento_del = (isset($_POST['atendimento_del'])) ? 1 : 0;

        // verificando errors
        new Classes\FiltroInput();

        // buscando usuarios cadastrados
        $search = $this->getList("WHERE login = '{$login}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, " ► Este login já existe. Por favor insira outro.<br />");
        endif;

        $search = $this->getList("WHERE email = '{$email}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, " ► Este e-mail já existe. Por favor insira outro.<br />");
        endif;

        // verificando errors
        new Classes\FiltroInput();


        $query = "UPDATE usuarios SET nome = :nome, login = :login , email = :email, tipo = :tipo WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':nome', $nome);
        $this->bind(':login', $login);
        $this->bind(':email', $email);
        $this->bind(':tipo', $tipo);

        if ($this->execute()):
            $query = "UPDATE usuarios_permissoes SET imovel_cad = :imovel_cad, imovel_edit = :imovel_edit, imovel_del = :imovel_del, "
                    . "fiador_cad = :fiador_cad, fiador_edit = :fiador_edit, fiador_del = :fiador_del, locatario_cad = :locatario_cad, "
                    . "locatario_edit = :locatario_edit, locatario_del = :locatario_del, proprietario_cad = :proprietario_cad, "
                    . "proprietario_edit = :proprietario_edit, proprietario_del = :proprietario_del, visita_cad = :visita_cad, "
                    . "visita_edit = :visita_edit, visita_del = :visita_del, servicos_cad = :servicos_cad, servicos_edit = :servicos_edit, "
                    . "servicos_del = :servicos_del, atendimento_edit = :atendimento_edit, atendimento_del = :atendimento_del "
                    . "WHERE usuarios_id = :id";
            $this->query($query);
            $this->bind(':id', $id);
            $this->bind(':imovel_cad', $imovel_cad);
            $this->bind(':imovel_edit', $imovel_edit);
            $this->bind(':imovel_del', $imovel_del);
            $this->bind(':fiador_cad', $fiador_cad);
            $this->bind(':fiador_edit', $fiador_edit);
            $this->bind(':fiador_del', $fiador_del);
            $this->bind(':locatario_cad', $locatario_cad);
            $this->bind(':locatario_edit', $locatario_edit);
            $this->bind(':locatario_del', $locatario_del);
            $this->bind(':proprietario_cad', $proprietario_cad);
            $this->bind(':proprietario_edit', $proprietario_edit);
            $this->bind(':proprietario_del', $proprietario_del);
            $this->bind(':visita_cad', $visita_cad);
            $this->bind(':visita_edit', $visita_edit);
            $this->bind(':visita_del', $visita_del);
            $this->bind(':servicos_cad', $servicos_cad);
            $this->bind(':servicos_edit', $servicos_edit);
            $this->bind(':servicos_del', $servicos_del);
            $this->bind(':atendimento_edit', $atendimento_edit);
            $this->bind(':atendimento_del', $atendimento_del);

            if ($this->execute()):
                // Inserindo log
                $Log = new Classes\Log();
                $Log->sistema_log("Editou um Usuário ($login)");
            endif;
        endif;
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $login = $_POST['login'];

        $query = "DELETE FROM usuarios_permissoes WHERE usuarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id); 
        $this->execute();
        
        $query = "DELETE FROM usuarios_tokens WHERE usuarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id); 
        $this->execute();
        
        $query = "DELETE FROM usuarios WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
               

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Usuário ($login)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM usuarios {$where} ORDER BY id DESC";
        $this->query($query);
        $this->execute();
        return $this->resultset();
    }

    public function search()
    {
        
    }

}
