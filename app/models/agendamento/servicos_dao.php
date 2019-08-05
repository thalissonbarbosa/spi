<?php

namespace App\Models\Agendamento;

use Lib\Base as Base;
use Lib\Classes as Classes;
use Lib\Interfaces as Interfaces;

/**
 * Description of visitas
 *
 * @author Thalisson
 */
class Servicos_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {

        $imovel = Classes\FiltroInput::input($_POST['imovel'], 'Imóvel');

        $data = Classes\FiltroInput::data($_POST['dataA'], 'Data');
        $data = dFormatDB($data);
        $hora = $_POST['hora'];
        $prestador = Classes\FiltroInput::input($_POST['prestador'], 'Prestador');
        $tipoServico = Classes\FiltroInput::input($_POST['tipoServico'], 'Tipo');
        $obs = addslashes($_POST['obs']);
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');

        // Campos obrigatórios
        Classes\FiltroInput::campoVazio($imovel, 'Imóvel');
        Classes\FiltroInput::campoVazioData($data);
        Classes\FiltroInput::campoVazio($prestador, 'Prestador');
        Classes\FiltroInput::campoVazio($tipoServico, 'Tipo');

        // Verificando array de Errors
        new Classes\FiltroInput();

        // inserindo no banco
        $query = "INSERT INTO ag_servicos(codigo_imovel, config_prestadores_id, config_tipo_servicos_id, dataServico, hora, obs, status) "
                . "VALUES (:imovel, :prestador, :tipoServico, :data, :hora , :obs, :status)";
        $this->query($query);
        $this->bind(':imovel', $imovel);
        $this->bind(':prestador', $prestador);
        $this->bind(':tipoServico', $tipoServico);
        $this->bind(':data', $data);
        $this->bind(':hora', $hora);
        $this->bind(':obs', $obs);
        $this->bind(':status', $status);
        $this->execute();
        $lastId = $this->lastInsertId();

        if ($lastId) {

            $url = URL_ROOT . "agendamento/editar_servico/$lastId";
            $url = "<a href='$url' target='blank'>$lastId</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Serviço ($url)");
            return;
        }
    }

    public function update()
    {

        $id = (int) $_POST['id'];

        $imovel = Classes\FiltroInput::input($_POST['imovel'], 'Imóvel');
        $data = Classes\FiltroInput::data($_POST['data'], 'Data');
        $data = dFormatDB($data);
        $hora = $_POST['hora'];
        $prestador = Classes\FiltroInput::input($_POST['prestador'], 'Prestador');
        $tipoServico = Classes\FiltroInput::input($_POST['tipoServico'], 'Tipo');
        $obs = addslashes($_POST['obs']);
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');

        // campos obrigatórios
        Classes\FiltroInput::campoVazio($imovel, 'Imóvel');
        Classes\FiltroInput::campoVazioData($data);
        Classes\FiltroInput::campoVazio($prestador, 'Prestador');
        Classes\FiltroInput::campoVazio($tipoServico, 'Tipo');

        // Verificando array de Errors
        new Classes\FiltroInput();

        // inserindo no banco
        $query = "UPDATE ag_servicos SET codigo_imovel = :imovel, config_prestadores_id = :prestador, config_tipo_servicos_id = :tipoServico, 
		dataServico = :data, hora = :hora, obs = :obs, status = :status WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':imovel', $imovel);
        $this->bind(':prestador', $prestador);
        $this->bind(':tipoServico', $tipoServico);
        $this->bind(':data', $data);
        $this->bind(':hora', $hora);
        $this->bind(':obs', $obs);
        $this->bind(':status', $status);

        if ($this->execute()) {
            $url = URL_ROOT . "agendamento/editar_servico/$id";
            $url = "<a href='$url' target='blank'>$id</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Serviço ($url)");
            return;
        }
    }

    public function delete()
    {

        $servico_id = (int) $_POST['servico_id'];

        if ($servico_id == 0) {
            return false;
        }

        $query = "DELETE FROM ag_servicos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $servico_id);
        $this->execute();
        $lastId = $this->lastInsertId();

        if ($lastId) {
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu uma Serviço ($servico_id)");
        }
    }

    public function search()
    {

        $busca = $_POST['busca'];
        $query = "SELECT * FROM vw_servicos WHERE codigo_imovel LIKE '%$busca%' OR prestador LIKE '%$busca%' or tipoServico LIKE '%$busca%' ORDER BY dataServico DESC, hora DESC";
        $this->query($query);
        $this->execute();
        $result = $this->resultSet();


        if ($this->numRows() == 0):
            echo "<td>Nenhum Serviço cadastrado.</td><td></td><td></td><td></td><td></td>";
        else:
            foreach ($result as $servico):
                $id = $servico['id'];
                $imovel = $servico['codigo_imovel'];
                $prestador = $servico['prestador'];
                $tipoServico = $servico['tipoServico'];
                $obs = $servico['obs'];
                $dataServico = dformat($servico['dataServico']);
                $hora = $servico['hora'];
                $status = $servico['status'];
                ?>
                <tr style="cursor: default">
                    <td><a href="<?= URL_ROOT; ?>imovel/detalhes/<?= $imovel; ?>" target="_blank" ><?= mb_ucwords($imovel); ?></a></td>
                    <td><?= mb_ucwords($prestador); ?></td>

                    <td><?= mb_ucwords($tipoServico); ?></td>

                    <td><?= $dataServico . " " . $hora; ?></td>
                    <td <?= ($status == "Finalizado") ? "class='verde'" : "class='laranja'" ?>><?= mb_ucwords($status); ?></td>
                    <td><a  title="<?= $obs; ?>"><img src="<?= DIR_IMG; ?>information.png" style="margin-right:10px;" /></a></td>
                    <td style="border:none; width:80px; background:#FFF;">

                        <?php if (permissao('servicos_edit')) {
                            ?>
                            <a href="editar_servico/<?= $id; ?>">
                                <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" /></a>
                        <?php }
                        ?>
                        <?php if (permissao('servicos_del')) {
                            ?>
                            <a href="#" onClick="javascript: excluir_servicos('<?= $id; ?>')" >
                                <img src="<?= DIR_IMG; ?>delete.png" style="margin-right:10px;" /></a>
                        <?php }
                        ?>	
                        <br />	
                        <span class="statusExcluir"></span>
                    </td>

                </tr>
                <?php
            endforeach;
        endif;
    }

    public function get($id)
    {
        $query = "SELECT * FROM ag_servicos WHERE id = :id";

        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();

        if ($this->numRows() == 0):
            Classes\Messages::setMsg('Nenhum serviço encontrado.', 'error');
            Classes\Messages::getMsg();
            return exit();
        else:
            return $this->result();
        endif;
    }

    public function getList()
    {

        $paginacao = Classes\Paginacao::setPaginacao();
        
        if (isset($_GET['orderby'])):
            $order = _GetString('orderby');
            (isset($_GET['o'])) ? $ordem = _GetString('o') : $ordem = "ASC";
            $query = "SELECT * FROM vw_servicos ORDER BY ${order} {$ordem}, hora DESC";
        else:
            $query = "SELECT * FROM vw_servicos ORDER BY dataServico DESC, hora DESC";
        endif;
        
        // Total sem limit
        $this->query($query);
        $this->execute();
        Classes\Paginacao::totalPaginas($this->numRows());
        
        // Adicionando Limit
        //$query .= " LIMIT $paginacao";

        $this->query($query);
        $this->execute();
        return $this->resultSet();
    }

}
