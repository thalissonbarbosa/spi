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
class Status_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $status = Classes\FiltroInput::input($_POST['status'], 'Nome');
        Classes\FiltroInput::campoVazio($status, 'Nome');
        $_POST['cor'] = str_replace('#', '', $_POST['cor']);
        $cor = Classes\FiltroInput::input($_POST['cor'], 'Cor');
        Classes\FiltroInput::campoVazio($cor, 'Cor');

        //verificando errors
        new Classes\FiltroInput();

        $search = $this->getList("WHERE stats = '{$status}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Status já cadastrado.<br />");
        endif;

        //verificando errors
        new Classes\FiltroInput();

        $query = "INSERT INTO config_stats(stats,cor) values (:status, :cor)";
        $this->query($query);
        $this->bind(':status', $status);
        $this->bind(':cor', $cor);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Status ($status)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $status = Classes\FiltroInput::input($_POST['status'], 'Nome');
        Classes\FiltroInput::campoVazio($status, 'Nome');
        $_POST['cor'] = str_replace('#', '', $_POST['cor']);
        $cor = Classes\FiltroInput::input($_POST['cor'], 'Cor');
        Classes\FiltroInput::campoVazio($cor, 'Cor');

        //verificando errors
        new Classes\FiltroInput();

        $search = $this->getList("WHERE stats = '{$status}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Status já cadastrado.<br />");
        endif;

        //verificando errors
        new Classes\FiltroInput();

        $query = "UPDATE config_stats SET stats = :stats, cor = :cor WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':stats', $status);
        $this->bind(':cor', $cor);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Status ($status)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $status = $_POST['status'];

        $query = "DELETE FROM config_stats WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Status ($status)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_stats WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_stats {$where} ORDER BY stats";
        $this->query($query);
        $this->execute();

        return $this->resultSet();

    }

    public function search()
    {
        
    }

}
