<?php

namespace App\Models\Imovel;

use Lib\Base as Base;

/**
 * Description of clientes_DAO
 *
 * @author Thalisson
 */
class Fiadores_DAO extends Base\Model
{
    /*
     * Insere clientes do imovel em Imovel/Editar
     * @Return True
     */

    public function insert(array $locatarios, array $fiadores, $tipo)
    {
        if ($tipo == 'fiador'):
            $locatario = $locatarios[0];
            // Verificando se há imoveis no array
            if ($fiadores[0] != ''):
                // inserindo cl_lo_fiadores
                foreach ($fiadores as $fiad):
                    // Verificando se já contém
                    $query = "SELECT * FROM cl_lo_fiadores WHERE cl_locatarios_id = :id_locatario AND cl_fiadores_id = :id_fiador";
                    $this->query($query);
                    $this->bind(':id_locatario', $locatario);
                    $this->bind(':id_fiador', $fiad);
                    $this->execute();
                    // Se não tiver na tabela, irá inserir
                    if ($this->numRows() == 0):
                        $query = "INSERT INTO cl_lo_fiadores(cl_fiadores_id, cl_locatarios_id) VALUES(:fiador, :locatario)";
                        $this->query($query);
                        $this->bind(':fiador', $fiad);
                        $this->bind(':locatario', $locatario);
                        $this->execute();
                    endif;
                endforeach;
            endif;
        elseif($tipo == 'locatario'):
            $fiador = $fiadores[0];
            // Verificando se há imoveis no array
            if ($locatarios[0] != ''):
                // inserindo cl_lo_fiadores
                foreach ($locatarios as $loca):
                    // Verificando se já contém
                    $query = "SELECT * FROM cl_lo_fiadores WHERE cl_locatarios_id = :id_locatario AND cl_fiadores_id = :id_fiador";
                    $this->query($query);
                    $this->bind(':id_locatario', $loca);
                    $this->bind(':id_fiador', $fiador);
                    $this->execute();
                    // Se não tiver na tabela, irá inserir
                    if ($this->numRows() == 0):
                        $query = "INSERT INTO cl_lo_fiadores(cl_fiadores_id, cl_locatarios_id) VALUES(:fiador, :locatario)";
                        $this->query($query);
                        $this->bind(':locatario', $loca);
                        $this->bind(':fiador', $fiador);
                        $this->execute();
                    endif;
                endforeach;
            endif;
        endif;
    }

    /*
     * Deleta associação locatario > fiador
     * @Return True
     */

    public function delete()
    {
        $id_fiador = $_POST['id_fiador'];
        $id_locatario = $_POST['id_locatario'];
        
        $query = "DELETE FROM cl_lo_fiadores WHERE cl_locatarios_id = :id_locatario AND cl_fiadores_id = :id_fiador";
        $this->query($query);
        $this->bind(':id_locatario', $id_locatario);
        $this->bind(':id_fiador', $id_fiador);
        $this->execute();
    }

    public function getAssoc($where = null)
    {
        $query = "SELECT * FROM cl_lo_fiadores $where";
        $this->query($query);
        $this->execute();
        return $this->resultset();
    }

}
