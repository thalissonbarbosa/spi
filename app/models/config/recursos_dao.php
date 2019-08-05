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
class Recursos_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $recurso = Classes\FiltroInput::input($_POST['recurso'], 'Recurso');
        Classes\FiltroInput::campoVazio($recurso, 'Recurso');



        // Buscando categorias cadastrados
        $search = $this->getList("WHERE nome = '{$recurso}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Recurso já cadastrado.<br />");
        endif;

        new Classes\FiltroInput();

        $query = "INSERT INTO config_recursos(nome) values (:recurso)";
        $this->query($query);
        $this->bind(':recurso', $recurso);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Recurso ($recurso)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $recurso = Classes\FiltroInput::input($_POST['recurso'], 'Recurso');

        new Classes\FiltroInput();

        // Buscando categorias cadastrados
        $search = $this->getList("WHERE nome = '{$recurso}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Recurso já cadastrado.<br />");
        endif;

        new Classes\FiltroInput();

        $query = "UPDATE config_recursos SET nome = :recurso WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':recurso', $recurso);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Recurso ($recurso)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $recurso = $_POST['recurso'];

        $query = "DELETE FROM config_recursos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Recurso ($recurso)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_recursos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_recursos {$where} ORDER BY nome";
        $this->query($query);
        $this->execute();

        return $this->resultset();
    }

    public function search()
    {
        
    }

}
