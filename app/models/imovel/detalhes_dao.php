<?php

namespace App\Models\Imovel;

use Lib\Base as Base;
use Lib\Classes as Classes;
use App\Models\Imovel as Imovel;

/**
 * Description of detalhes_DAO
 *
 * @author Thalisson
 */
class Detalhes_DAO extends Base\Model
{
    public function insert($id_imovel, array $detalhes)
    {
        $query = "INSERT INTO imovel_detalhes (imovel_id, mat_agespisa, mat_eletrobras, iptu, valor_iptu, exclusividade, ocupacao, posicao, "
                . "topografia, area_util, area_construida, area_terreno) VALUES (:imovel_id, :matAgespisa, :matEletrobras, :iptu, :valorIptu,"
                . ":exclusividade, :ocupacao, :posicao, :topografia, :areaUtil, :areaConstruida, :areaTerreno)";

        $this->query($query);
        $this->bind(':imovel_id', $id_imovel);
        $this->bind(':matAgespisa', $detalhes['matAgespisa']);
        $this->bind(':matEletrobras', $detalhes['matEletrobras']);
        $this->bind(':iptu', $detalhes['iptu']);
        $this->bind(':valorIptu', $detalhes['valorIptu']);
        $this->bind(':exclusividade', $detalhes['exclusividade']);
        $this->bind(':ocupacao', $detalhes['ocupacao']);
        $this->bind(':posicao', $detalhes['posicao']);
        $this->bind(':topografia', $detalhes['topografia']);
        $this->bind(':areaUtil', $detalhes['areaUtil']);
        $this->bind(':areaConstruida', $detalhes['areaConstruida']);
        $this->bind(':areaTerreno', $detalhes['areaTerreno']);
        $this->execute();
    }
    
    public function update($id_imovel, array $detalhes)
    {                
        $query = "UPDATE imovel_detalhes SET mat_agespisa = :matAgespisa, mat_eletrobras = :matEletrobras, iptu = :iptu, valor_iptu = :valorIptu, "
                . "exclusividade = :exclusividade, ocupacao = :ocupacao, posicao = :posicao, topografia = :topografia, area_util = :areaUtil, "
                . "area_construida = :areaConstruida, area_terreno = :areaTerreno WHERE imovel_id = :imovel_id";

        $this->query($query);
        $this->bind(':matAgespisa', $detalhes['matAgespisa']);
        $this->bind(':matEletrobras', $detalhes['matEletrobras']);
        $this->bind(':iptu', $detalhes['iptu']);
        $this->bind(':valorIptu', $detalhes['valorIptu']);
        $this->bind(':exclusividade', $detalhes['exclusividade']);
        $this->bind(':ocupacao', $detalhes['ocupacao']);
        $this->bind(':posicao', $detalhes['posicao']);
        $this->bind(':topografia', $detalhes['topografia']);
        $this->bind(':areaUtil', $detalhes['areaUtil']);
        $this->bind(':areaConstruida', $detalhes['areaConstruida']);
        $this->bind(':areaTerreno', $detalhes['areaTerreno']);
        $this->bind(':imovel_id', $id_imovel);
        $this->execute();
    }
    
    public function get($id_imovel)
    {
        $query = "SELECT * FROM imovel_detalhes WHERE imovel_id = :id";
        $this->query($query);
        $this->bind(':id', $id_imovel);
        $this->execute();
        return $this->result();
    }

    

}
