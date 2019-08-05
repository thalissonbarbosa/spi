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
class Atributos_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $atributo = Classes\FiltroInput::input($_POST['atributo'], 'Atributo');
        Classes\FiltroInput::campoVazio($atributo, 'Atributo');

        // verificando errors
        new Classes\FiltroInput();

        // Buscando atributos cadastrados
        $search = $this->getList("WHERE nome = '{$atributo}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Atributo já cadastrado.<br />");
        endif;

        // verificando errors
        new Classes\FiltroInput();

        $query = "INSERT INTO config_atributos(nome) values (:atributo)";
        $this->query($query);
        $this->bind(':atributo', $atributo);
        if ($this->execute()):
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Atributo ($atributo)");
        endif;
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $atributo = Classes\FiltroInput::input($_POST['atributo'], 'Atributo');
        Classes\FiltroInput::campoVazio($atributo, 'Atributo');


        // verificando errors
        new Classes\FiltroInput();

        // Buscando atributos cadastrados
        $search = $this->getList("WHERE nome = '{$atributo}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Atributo já cadastrado.<br />");
        endif;

        // verificando errors
        new Classes\FiltroInput();

        $query = "UPDATE config_atributos SET nome = :atributo where id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':atributo', $atributo);

        if ($this->execute()):
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Atributo ($atributo)");
        endif;
    }

    public function delete()
    {
        $id = $_POST['id'];
        $atributo = $_POST['atributo'];

        $query = "DELETE FROM config_atributos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Atributo ($atributo)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_atributos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {

        $query = "SELECT * FROM config_atributos {$where} ORDER BY nome";
        $this->query($query);
        $this->execute();
        
        return $this->resultset();
        
    }

    public function search()
    {
        
    }

}
