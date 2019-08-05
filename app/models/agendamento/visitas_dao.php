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
class Visitas_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $imovel = Classes\FiltroInput::input($_POST['imovel'], 'Imóvel');
        $cliente = Classes\FiltroInput::input($_POST['cliente'], 'Cliente');
        $tel = Classes\FiltroInput::input($_POST['telefone'], 'Telefone');
        $responsavel = Classes\FiltroInput::input($_POST['responsavel'], 'Responsável');
        $obs = addslashes($_POST['obs']);
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');
        $usuario = $_SESSION['user']['nome'];
        $data = Classes\FiltroInput::data($_POST['data'], 'Data');
        $data = dFormatDB($data);
        $hora = addslashes($_POST['hora']);
        
        // Campos Obrigatórios
        Classes\FiltroInput::campoVazio($imovel, 'Imóvel');
        Classes\FiltroInput::campoVazio($cliente, 'Cliente');
        Classes\FiltroInput::campoVazio($responsavel, 'Responsável');
        Classes\FiltroInput::campoVazioData($data);        

        // Verificando se há errors
        new Classes\FiltroInput();

        $query = "INSERT INTO ag_visitas(codigo_imovel, dataVisita, hora, cliente, telefone, responsavel, obs, status, usuario) "
                . "VALUES (:imovel, :data, :hora , :cliente, :tel, :responsavel, :obs, :status, :usuario)";
        $this->query($query);
        $this->bind(':imovel', $imovel);
        $this->bind(':data', $data);
        $this->bind(':hora', $hora);
        $this->bind(':cliente', $cliente);
        $this->bind(':tel', $tel);
        $this->bind(':responsavel', $responsavel);
        $this->bind(':obs', $obs);
        $this->bind(':status', $status);
        $this->bind(':usuario', $usuario);
        $this->execute();
        $lastId = $this->lastInsertId();
        if ($lastId):
            $url = URL_ROOT . "agendamento/editar_visita/$lastId";
            $url = "<a href='$url' target='blank'>$lastId</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou uma Visita ($url)");
        endif;
    }

    public function update()
    {

        $id = $_POST['id'];
        $imovel = Classes\FiltroInput::input($_POST['imovel'], 'Imóvel');
        $cliente = Classes\FiltroInput::input($_POST['cliente'], 'Cliente');
        $tel = Classes\FiltroInput::input($_POST['telefone'], 'Telefone');
        $responsavel = Classes\FiltroInput::input($_POST['responsavel'], 'Responsável');
        $obs = addslashes($_POST['obs']);
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');
        $usuario = $_SESSION['user']['nome'];
        $data = Classes\FiltroInput::data($_POST['data'], 'Data');
        $data = dFormatDB($data);
        $hora = addslashes($_POST['hora']);

        Classes\FiltroInput::campoVazio($imovel, 'Imóvel');
        Classes\FiltroInput::campoVazio($cliente, 'Cliente');
        Classes\FiltroInput::campoVazio($cliente, 'Responsável');
        Classes\FiltroInput::campoVazioData($cliente, 'Data');

        // Verificando se há errors
        new Classes\FiltroInput();

        $query = "UPDATE ag_visitas SET codigo_imovel = :imovel, dataVisita = :data, hora = :hora, cliente = :cliente, telefone = :tel, "
                . "responsavel = :responsavel, obs = :obs, status = :status WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':imovel', $imovel);
        $this->bind(':data', $data);
        $this->bind(':hora', $hora);
        $this->bind(':cliente', $cliente);
        $this->bind(':tel', $tel);
        $this->bind(':responsavel', $responsavel);
        $this->bind(':obs', $obs);
        $this->bind(':status', $status);

        if ($this->execute()):
            $url = URL_ROOT . "agendamento/editar_visita/$id";
            $url = "<a href='$url' target='blank'>$id</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Editou uma Visita ($url)");
        endif;
    }

    public function delete()
    {
        $id = $_POST['visita_id'];

        $query = "DELETE FROM ag_visitas WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()):
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu uma Visita ($id)");
        endif;
    }

    public function search()
    {
        $busca = $_POST['busca'];

        $query = "SELECT * FROM ag_visitas WHERE codigo_imovel LIKE '%{$busca}%' OR cliente LIKE '%{$busca}%' OR responsavel LIKE '%{$busca}%'";
        $this->query($query);
        $this->execute();
        $result = $this->resultSet();

        if ($this->numRows() == 0) {
            echo "<td>Nenhuma visita encontrada.</td><td></td><td></td><td></td><td></td><td></td>";
        } else {
            foreach ($result as $visita) {
                ?>
                <tr style="cursor: default">
                    <td style="width: auto;" ><a href="<?= URL_ROOT; ?>imovel/detalhes/<?= $visita['codigo_imovel']; ?>" target="_blank" ><?= mb_ucwords($visita['codigo_imovel']); ?></a></td>
                    <td><?= mb_ucwords($visita['cliente']); ?></td>

                    <td><?= $visita['telefone']; ?></td>
                    <td><?= mb_ucwords($visita['responsavel']); ?></td>

                    <td><?= dformat($visita['dataVisita']) . " " . $visita['hora']; ?></td>
                    <td <?= ($visita['status'] == "Finalizado") ? "class='verde'" : "class='laranja'" ?>><?= mb_ucwords($visita['status']); ?></td>
                    <td>
                        <a  title="<?= ucfirst($visita['obs']); ?>"><img src="<?= DIR_IMG; ?>information.png" /></a>
                    </td>
                    <td>
                        <a  title="<?= 'Cadastrado por ' . $visita['usuario']; ?>"><img src="<?= DIR_IMG; ?>icon-history.png" /></a>
                    </td>
                    <td style="border:none; width:80px; background:#FFF;">

                        <?php if (permissao('visita_edit')) {
                            ?>
                            <a href="./editar_visita/<?= $visita['id']; ?>" >
                                <img src="<?= DIR_IMG; ?>edit.png" style="margin-left:20px;" /></a>
                        <?php }
                        ?>
                        <?php if (permissao('visita_del')) {
                            ?>
                            <a href="#" onClick="javascript: excluir_visita('<?= $visita['id']; ?>')" >
                                <img src="<?= DIR_IMG; ?>delete.png" style="margin-left:10px;" /></a>
                        <?php }
                        ?>	
                        <br />	
                        <span class="statusExcluir"></span>
                    </td>

                </tr>
                <?php
            }
        }
    }

    public function get($id)
    {

        $query = "SELECT * FROM ag_visitas WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();

        if ($this->numRows() == 0):
            Classes\Messages::setMsg('Nenhuma visita encontrada.', 'error');
            Classes\Messages::getMsg();
            return exit();
        else:
            return $this->result();
        endif;
    }

    public function getList()
    {
        $paginacao = Classes\Paginacao::setPaginacao();
        

        if (isset($_GET['orderby'])) {
            $order = _GetString('orderby');
            (isset($_GET['o'])) ? $ordem = _GetString('o') : $ordem = "ASC";
            $query = "SELECT * FROM ag_visitas ORDER BY {$order} {$ordem}, hora DESC";
        } else {
            $query = "SELECT * FROM ag_visitas ORDER BY dataVisita DESC, hora DESC";
        }
        
        $this->query($query);
        $this->execute();
        Classes\Paginacao::totalPaginas($this->numRows());
        //$query .= " LIMIT {$paginacao}";

        $this->query($query);
        $this->execute();
        return $this->resultSet();
    }

}
