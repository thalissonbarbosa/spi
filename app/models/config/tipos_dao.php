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
class Tipos_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Nome');
        Classes\FiltroInput::campoVazio($tipo, 'Nome');

        // verificando errors
        new Classes\FiltroInput();

        // procurando se o tipo está cadastrado
        $search = $this->getList("WHERE tipo = '{$tipo}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Tipo já cadastrado.<br />");
        endif;

        //verificando errors
        new Classes\FiltroInput();

        $query = "INSERT INTO config_tipo(tipo) values (:tipo)";
        $this->query($query);
        $this->bind(':tipo', $tipo);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Tipo ($tipo)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Nome');
        Classes\FiltroInput::campoVazio($tipo, 'Nome');

        // verificando errors
        new Classes\FiltroInput();

        // procurando se o tipo está cadastrado
        $search = $this->getList("WHERE tipo = '{$tipo}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Tipo já cadastrado.<br />");
        endif;

        //verificando errors
        new Classes\FiltroInput();

        $query = "UPDATE config_tipo SET tipo = :tipo WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':tipo', $tipo);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Tipo ($tipo)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $tipo = $_POST['tipo'];

        $query = "DELETE FROM config_tipo WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Tipo ($tipo)");
        }
    }

    public function get($id)
    {
        $query = "SELECT * FROM config_tipo WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_tipo {$where} ORDER BY tipo";
        $this->query($query);
        $this->execute();
        return $this->resultset();
    }

    public function search()
    {
        
    }

}
