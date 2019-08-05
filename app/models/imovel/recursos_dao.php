<?php

namespace App\Models\Imovel;

use Lib\Base as Base;
use Lib\Classes as Classes;

/**
 * Description of recursos_DAO
 *
 * @author Thalisson
 */
class Recursos_DAO extends Base\Model
{

    public function update()
    {
        $codigo = $_POST['codigo'];
        
        // Pegando campos marcados
        if (!isset($_POST['camposMarcados'])) {
            $camposMarcados = array();
        } else {
            $camposMarcados = $_POST['camposMarcados'];
        }

        // Pegando id do imovel
        $Imovel_DAO = new Imovel_DAO();
        $imovel = $Imovel_DAO->get($codigo);
        $id_imovel = $imovel['id'];

        // Pegando os antigos recursos cadastrados no imovel
        $this->query("SELECT * FROM imovel_recursos WHERE imovel_id = '$id_imovel'");
        $this->execute();
        $recursos_old = $this->resultSet();

        // Criando um array com todos os IDs
        $recursos_old_ids = array();
        foreach ($recursos_old as $value):
            array_push($recursos_old_ids, $value['recursos_id']);
        endforeach;

        // Criando um array dos recursos que não estão marcados e que estão cadastrados
        $recursos_remove = array_diff($recursos_old_ids, $camposMarcados);

        // Excluindo os recursos que não estão marcados
        foreach ($recursos_remove as $remove):
            $query = "DELETE FROM imovel_recursos WHERE imovel_id = :id_imovel AND recursos_id = :id_recursos ";
            $this->query($query);
            $this->bind(':id_imovel', $id_imovel);
            $this->bind(':id_recursos', $remove);
            $this->execute();
        endforeach;

        // Criando um array com os recursos que estão marcados e não estão cadastrados
        $recursos_add = array_diff($camposMarcados, $recursos_old_ids);

        // Adicionando novos recursos
        foreach ($recursos_add as $add):
            $query = "INSERT INTO imovel_recursos(imovel_id, recursos_id) VALUES (:id_imovel, :id_recurso); ";
            $this->query($query);
            $this->bind(':id_imovel', $id_imovel);
            $this->bind(':id_recurso', $add);
            $this->execute();
        endforeach;

        // Inserindo no arquivo de log
        $url = URL_ROOT . "imovel/detalhes/{$codigo}";
        $url = "<a href='{$url}' target='blank'>{$codigo}</a>";
        $Log = new Classes\Log();
        $Log->sistema_log("Editou um Imóvel ({$url}) {update recursos}");
    }

    public function getListFrom($imovel_codigo)
    {
        $query = "SELECT * FROM vw_recursos WHERE codigo_imovel = :codigo ORDER BY nome";
        $this->query($query);
        $this->bind(':codigo', $imovel_codigo);
        $this->execute();
        return $this->resultSet();
        
    }

}
