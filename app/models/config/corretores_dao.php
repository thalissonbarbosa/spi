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
class Corretores_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $corretor = Classes\FiltroInput::input($_POST['corretor'], 'Corretor');
        Classes\FiltroInput::campoVazio($corretor, 'Corretor');

        // Verificando errors
        new Classes\FiltroInput();

        // Buscando corretores cadastrados
        $search = $this->getList("WHERE corretor = '{$corretor}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Corretor já cadastrado.<br />");
        endif;

        // Verificando errors
        new Classes\FiltroInput;

        $query = "INSERT INTO config_corretor(corretor) values (:corretor)";
        $this->query($query);
        $this->bind(':corretor', $corretor);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Corretor ($corretor)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $corretor = Classes\FiltroInput::input($_POST['corretor'], 'Corretor');
        Classes\FiltroInput::campoVazio($corretor, 'Corretor');

        // Verificando errors
        new Classes\FiltroInput();

        // Buscando corretores cadastrados
        $search = $this->getList("WHERE corretor = '{$corretor}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Corretor já cadastrado.<br />");
        endif;

        // Verificando errors
        new Classes\FiltroInput;

        $query = "UPDATE config_corretor SET corretor = :corretor WHERE id = :id ";
        $this->query($query);
        $this->bind(':corretor', $corretor);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Corretor ($corretor)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $corretor = $_POST['corretor'];

        $query = "DELETE FROM config_corretor WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Corretor ($corretor)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_corretor WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_corretor {$where} ORDER BY id DESC";
        $this->query($query);
        $this->execute();
        
        return $this->resultset();
        
    }

    public function search()
    {
        
    }

}
