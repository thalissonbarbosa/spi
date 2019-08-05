<?php

namespace App\Models\Config;

use Lib\Base as Base;
use Lib\Classes as Classes;
use Lib\Interfaces as Interfaces;

/**
 * Description of atributos_DAO
 *
 * @author Thalisson
 */
class Servicos_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $nome = Classes\FiltroInput::input($_POST['servico'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');

        // verificando errors
        new Classes\FiltroInput();

        $search = $this->getList("WHERE tipo = '{$nome}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Tipo de Serviço já cadastrado.<br />");
        endif;

        // Verificando errors
        new Classes\FiltroInput();

        $query = "INSERT INTO config_tipo_servicos(tipo) values (:nome)";
        $this->query($query);
        $this->bind(':nome', $nome);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Tipo de Serviço ($nome)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $nome = Classes\FiltroInput::input($_POST['servico'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');

        // verificando errors
        new Classes\FiltroInput();

        $search = $this->getList("WHERE tipo = '{$nome}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Tipo de Serviço já cadastrado.<br />");
        endif;

        // Verificando errors
        new Classes\FiltroInput();

        $query = "UPDATE config_tipo_servicos SET tipo = :nome WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':nome', $nome);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Tipo de Serviço ($nome)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $tipo = $_POST['tipoServico'];

        $query = "DELETE FROM config_tipo_servicos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Tipo de Serviço ($tipo)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_tipo_servicos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_tipo_servicos {$where} ORDER BY tipo";
        $this->query($query);
        $this->execute();
        
        return $this->resultset();
        
    }

    public function search()
    {
        
    }

}
