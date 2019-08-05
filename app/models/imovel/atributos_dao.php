<?php

namespace App\Models\Imovel;

use Lib\Base as Base;
use Lib\Classes as Classes;

/**
 * Description of atributos_DAO
 *
 * @author Thalisson
 */
class Atributos_DAO extends Base\Model
{

    public function add()
    {
        $codigo = $_POST['codigo'];
        $id_atributo = $_POST['atributo_id'];
        $qtd = $_POST['qtd'];

        // Pegando id do imovel
        $Imovel_DAO = new Imovel_DAO();
        $result = $Imovel_DAO->get($codigo);
        $id_imovel = $result['id'];

        new Classes\FiltroInput();

        // Buscando atributos já cadastrados deste imóvel
        $query = "SELECT * FROM vw_atributos WHERE codigo_imovel = :codigo AND id_atributo = :id_atributo";
        $this->query($query);
        $this->bind(':id_atributo', $id_atributo);
        $this->bind(':codigo', $codigo);
        $this->execute();

        if ($this->numRows() == 0) {

            $query = "INSERT INTO imovel_atributos(imovel_id, atributos_id, quantidade) VALUES (:id_imovel, :id_atributo, :qtd)";
            $this->query($query);
            $this->bind(':id_imovel', $id_imovel);
            $this->bind(':id_atributo', $id_atributo);
            $this->bind(':qtd', $qtd);
        } else {

            $query = "UPDATE imovel_atributos SET quantidade = :qtd WHERE imovel_id = :id_imovel and atributos_id = :id_atributo ";
            $this->query($query);
            $this->bind(':id_imovel', $id_imovel);
            $this->bind(':id_atributo', $id_atributo);
            $this->bind(':qtd', $qtd);
        }

        if ($this->execute()):
            // Inserindo no arquivo de log
            $url = URL_ROOT . "imovel/detalhes/{$codigo}";
            $url = "<a href='{$url}' target='blank'>{$codigo}</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Imóvel ($url) {add atributos}");
        endif;
    }

    public function remove()
    {
        $codigo = $_POST['codigo'];
        $id_atributo = $_POST['atributo_id'];

        // Pegando id do imovel
        $Imovel_DAO = new Imovel_DAO();
        $result = $Imovel_DAO->get($codigo);
        $id_imovel = $result['id'];

        new Classes\FiltroInput();

        $query = "DELETE FROM imovel_atributos WHERE imovel_id = :id_imovel AND atributos_id = :id_atributo";
        $this->query($query);
        $this->bind(':id_imovel', $id_imovel);
        $this->bind(':id_atributo', $id_atributo);

        if ($this->execute()) {
            // Inserindo no arquivo de log
            $url = URL_ROOT . "imovel/detalhes/{$codigo}";
            $url = "<a href='{$url}' target='blank'>{$codigo}</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Imóvel ({$url}) {del atributo}");
        }
    }

    public function getListFrom($imovel_codigo)
    {
        $query = "SELECT * FROM vw_atributos WHERE codigo_imovel = :codigo ORDER BY nome";
        $this->query($query);
        $this->bind(':codigo', $imovel_codigo);
        $this->execute();
        return $this->resultSet();

        
    }

}
