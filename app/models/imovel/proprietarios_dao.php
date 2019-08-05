<?php

namespace App\Models\Imovel;

use Lib\Base as Base;

/**
 * Description of proprietarios_DAO
 *
 * @author Thalisson
 */
class Proprietarios_DAO extends Base\Model
{
    /*
     * Insere proprietarios do imóvel em Imovel/Editar
     * @Return True 
     */

    public function insert(array $prop_imovel, $codigo)
    {
        // Verificando se há imoveis no array
        if ($prop_imovel[0] != ''):
            // inserindo imovel_proprietarios
            foreach ($prop_imovel as $prop):

                // Verificando se já contém
                $query = "SELECT * FROM imovel_proprietarios WHERE cl_proprietarios_id = :prop AND codigo_imovel = :codigo";
                $this->query($query);
                $this->bind(':prop', $prop);
                $this->bind(':codigo', $codigo);
                $this->execute();

                // Se não tiver na tabela, irá inserir
                if ($this->numRows() == 0):

                    $query = "INSERT INTO imovel_proprietarios(codigo_imovel, cl_proprietarios_id) VALUES(:codigo, :prop)";
                    $this->query($query);
                    $this->bind(':prop', $prop);
                    $this->bind(':codigo', $codigo);
                    $this->execute();

                endif;
            endforeach;
        endif;
    }

    /*
     * Deleta o proprietario do imovel
     */

    public function delete()
    {
        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        
        $query = "DELETE FROM imovel_proprietarios WHERE codigo_imovel = :codigo AND cl_proprietarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':codigo', $codigo);
        $this->execute();
    }

    /*
     * Pega todos os proprietarios do imovel
     * @Return array
     */

    public function getList($where = null)
    {
        $query = "SELECT * FROM imovel_proprietarios {$where} ORDER BY codigo_imovel ASC";
        $this->query($query);
        $this->execute();

        return $this->resultSet();
    }

    /*
     * Search dos Proprietarios
     */

    public function search()
    {
    }

}
