<?php

namespace App\Models\Config;

use Lib\Classes as Classes;
use Lib\Base as Base;
use Lib\Interfaces as Interfaces;

/**
 * Description of categoria_DAO
 *
 * @author Thalisson
 */
class Categorias_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $categoria = Classes\FiltroInput::input($_POST['categoria'], 'Categoria');
        Classes\FiltroInput::campoVazio($categoria, 'Categoria');
        $_POST['cor'] = str_replace('#', '', $_POST['cor']);
        $cor = Classes\FiltroInput::input($_POST['cor'], 'Cor');
        Classes\FiltroInput::campoVazio($cor, 'Cor');

        // verificando errors
        new Classes\FiltroInput();

        // Buscando categorias cadastrados
        $search = $this->getList("WHERE categoria = '{$categoria}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Categoria já cadastrada.<br />");
        endif;

        // Verificando errors
        new Classes\FiltroInput;

        $query = "INSERT INTO config_categoria(categoria,cor) values (:categoria, :cor)";
        $this->query($query);
        $this->bind(':categoria', $categoria);
        $this->bind(':cor', $cor);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou uma Categoria ($categoria)");
        }
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $categoria = Classes\FiltroInput::input($_POST['categoria'], 'Categoria');
        Classes\FiltroInput::campoVazio($categoria, 'Categoria');
        $_POST['cor'] = str_replace('#', '', $_POST['cor']);
        $cor = Classes\FiltroInput::input($_POST['cor'], 'Cor');
        Classes\FiltroInput::campoVazio($cor, 'Cor');

        // verificando errors
        new Classes\FiltroInput();

        // Buscando categorias cadastrados
        $search = $this->getList("WHERE categoria = '{$categoria}' AND id != '{$id}'");

        if (count($search) > 0):
            array_push(Classes\FiltroInput::$Errors, "► Categoria já cadastrada.<br />");
        endif;

        // Verificando errors
        new Classes\FiltroInput;

        $query = "UPDATE config_categoria SET categoria = :categoria, cor = :cor WHERE id = :id ";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':categoria', $categoria);
        $this->bind(':cor', $cor);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Editou uma Categoria ($categoria)");
        }
    }

    public function delete()
    {
        $id = (int) $_POST['id'];
        $categoria = $_POST['categoria'];

        $query = "DELETE FROM config_categoria WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()) {
            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu uma Categoria ($categoria)");
        }
    }

    public function get($param)
    {
        $query = "SELECT * FROM config_categoria WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $param);
        $this->execute();
        return $this->result();
    }

    public function getList($where = null)
    {
        $query = "SELECT * FROM config_categoria {$where} ORDER BY categoria";
        $this->query($query);
        $this->execute();

        return $this->resultset();
        
    }

    public function search()
    {
        
    }

}
