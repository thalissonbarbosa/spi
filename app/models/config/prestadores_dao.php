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
class Prestadores_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $telefone = Classes\FiltroInput::input($_POST['telefone'], 'Telefone');
        Classes\FiltroInput::campoVazio($telefone, 'Telefone');
        $telefone2 = Classes\FiltroInput::input($_POST['telefone2'], 'Telefone 2');
        $telefone3 = Classes\FiltroInput::input($_POST['telefone3'], 'Telefone 3');
        $tipoServico = Classes\FiltroInput::input($_POST['tipoServico'], 'Tipo de Serviço');
        Classes\FiltroInput::campoVazio($tipoServico, 'Tipo de Serviço');

        new Classes\FiltroInput();

        $query = "INSERT INTO config_prestadores(nome, telefone, telefone2, telefone3, config_tipo_servicos_id) "
                . "values (:nome, :telefone, :telefone2, :telefone3, :tipoServico)";
        $this->query($query);
        $this->bind('nome', $nome);
        $this->bind('telefone', $telefone);
        $this->bind('telefone2', $telefone2);
        $this->bind('telefone3', $telefone3);
        $this->bind('tipoServico', $tipoServico);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Prestador ($nome)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $telefone = Classes\FiltroInput::input($_POST['telefone'], 'Telefone');
        Classes\FiltroInput::campoVazio($telefone, 'Telefone');
        $telefone2 = Classes\FiltroInput::input($_POST['telefone2'], 'Telefone 2');
        $telefone3 = Classes\FiltroInput::input($_POST['telefone3'], 'Telefone 3');
        $tipoServico = Classes\FiltroInput::input($_POST['tipoServico'], 'Tipo de Serviço');
        Classes\FiltroInput::campoVazio($tipoServico, 'Tipo de Serviço');

        new Classes\FiltroInput();

        $query = "UPDATE config_prestadores SET nome = :nome, telefone = :telefone, telefone2 = :telefone2, telefone3 = :telefone3, "
                . "config_tipo_servicos_id = :tipoServico WHERE id = :id ";

        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':nome', $nome);
        $this->bind(':telefone', $telefone);
        $this->bind(':telefone2', $telefone2);
        $this->bind(':telefone3', $telefone3);
        $this->bind(':tipoServico', $tipoServico);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Prestador ($nome)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $prestador = $_POST['prestador'];

        //mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
        $query = "DELETE FROM config_prestadores WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Prestador ($prestador)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_prestadores WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_prestadores {$where} ORDER BY id DESC";
        $this->query($query);
        $this->execute();
        
        return $this->resultset();
        
    }

    public function search()
    {
        
    }

}
