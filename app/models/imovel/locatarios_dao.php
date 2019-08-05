<?php

namespace App\Models\Imovel;

use Lib\Base as Base;

/**
 * Description of clientes_DAO
 *
 * @author Thalisson
 */
class Locatarios_DAO extends Base\Model
{
    /*
     * Insere clientes do imovel em Imovel/Editar
     * @Return True
     */

    public function insert(array $cliente_imovel, $codigo)
    {
        // Verificando se há imoveis no array
        if ($cliente_imovel[0] != ''):
            // inserindo imovel_locatarios
            foreach ($cliente_imovel as $cliente):
                // Verificando se já contém
                $query = "SELECT * FROM imovel_locatarios WHERE cl_locatarios_id = :cliente AND codigo_imovel = :codigo";
                $this->query($query);
                $this->bind(':cliente', $cliente);
                $this->bind(':codigo', $codigo);
                $this->execute();
                // Se não tiver na tabela, irá inserir
                if ($this->numRows() == 0):
                    $query = "INSERT INTO imovel_locatarios(cl_locatarios_id, codigo_imovel) VALUES(:cliente, :codigo)";
                    $this->query($query);
                    $this->bind(':cliente', $cliente);
                    $this->bind(':codigo', $codigo);
                    $this->execute();
                endif;
            endforeach;
        endif;
    }

    /*
     * Deleta clientes ou proprietarios em Imovel/Editar
     * @Return True
     */

    public function delete()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];

        $query = "DELETE FROM imovel_locatarios WHERE codigo_imovel = :codigo AND cl_locatarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':codigo', $codigo);
        $this->execute();
    }

    /*
     * Pega todos os locatarios do imóvel
     * @Return array
     */

    public function getList($where = null)
    {
        $query = "SELECT * FROM imovel_locatarios $where";
        $this->query($query);
        $this->execute();
        return $this->resultSet();
    }

}
