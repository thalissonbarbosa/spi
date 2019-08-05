<?php

namespace App\Models\Imovel;

use Lib\Interfaces as Interfaces;
use Lib\Base as Base;
use Lib\Classes as Classes;
use App\Models\Imovel as Imovel;
use App\Models\Config as Config;

/**
 * Description of imovel_DAO
 *
 * @author Thalisson
 */
class Imovel_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $codigo = Classes\FiltroInput::input($_POST['codigo'], 'Código');
        $ref = Classes\FiltroInput::ref($_POST['ref']);
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Tipo');
        $categoria = Classes\FiltroInput::input($_POST['categoria'], 'Categoria');
        $valor = nFormatDB($_POST['valor']);
        $corretor = Classes\FiltroInput::input($_POST['corretor'], 'Corretor');
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');
        $condominio = Classes\FiltroInput::input($_POST['condominio'], 'Condomínio/Edifício');
        $taxaCond = nFormatDB($_POST['taxaCond']);
        $nchave = Classes\FiltroInput::input($_POST['nchave'], 'Chave');
        $napt = Classes\FiltroInput::input($_POST['napt'], 'Nº Apt');
        $cep = Classes\FiltroInput::input($_POST['cep'], 'CEP');
        $rua = Classes\FiltroInput::input($_POST['rua'], 'Rua');
        $numero = $_POST['numero'];
        $cidade = Classes\FiltroInput::input($_POST['cidade'], 'Cidade');
        $bairro = Classes\FiltroInput::input($_POST['bairro'], 'Bairro');
        $zona = Classes\FiltroInput::input($_POST['zona'], 'Zona');
        $obs = addslashes($_POST['obs']);

        // Campos obrigatórios
        Classes\FiltroInput::campoVazio($codigo, 'Código');
        Classes\FiltroInput::campoVazio($valor, 'Valor');
        //Classes\FiltroInput::campoVazio($rua, 'Rua');

        // Verifica Código
        $this->query("SELECT codigo FROM imovel");
        $this->execute();
        $result = $this->resultSet();
        foreach ($result as $imovel):
            if ($codigo == $imovel['codigo']):
                array_push(Classes\FiltroInput::$Errors, "► Código já existe!<br />");
            endif;
        endforeach;

        // Detalhes
        $detalhes = array(
            'matAgespisa' => Classes\FiltroInput::input($_POST['matAgespisa'], 'Mat. Agespisa'),
            'matEletrobras' => Classes\FiltroInput::input($_POST['matEletrobras'], 'Mat. Eletrobras'),
            'posicao' => Classes\FiltroInput::input($_POST['posicao'], 'Posição'),
            'topografia' => Classes\FiltroInput::input($_POST['topografia'], 'Topografia'),
            'iptu' => Classes\FiltroInput::input($_POST['iptu'], 'IPTU'),
            'valorIptu' => nFormatDB($_POST['valorIptu']),
            'areaUtil' => Classes\FiltroInput::input($_POST['areaUtil'], 'Área Util'),
            'areaTerreno' => Classes\FiltroInput::input($_POST['areaTerreno'], 'Área Terreno'),
            'areaConstruida' => Classes\FiltroInput::input($_POST['areaConstruida'], 'Área Construída'),
            'exclusividade' => Classes\FiltroInput::input($_POST['exclusividade'], 'Exclusividade'),
            'ocupacao' => Classes\FiltroInput::input($_POST['ocupacao'], 'Ocupação')
        );

        // proprietarios
        if (isset($_POST['proprietarios'])):
            $prop_imovel = $_POST['proprietarios'];
        else:
            $prop_imovel = array();
            array_push($prop_imovel, '');
        endif;

        // clientes
        if (isset($_POST['locatarios'])):
            $locatario_imovel = $_POST['locatarios'];
        else:
            $locatario_imovel = array();
            array_push($locatario_imovel, '');
        endif;

        // verificando errors
        new Classes\FiltroInput();

        // Inserting Dados do Imovel
        $query = "INSERT INTO imovel (codigo, ref, tipo_id, categoria_id, valor, corretor_id, stats_id, condominio, taxaCond, nchave, napt, cep, "
                . "endereco, numero, cidade, bairro, zona, obs) VALUES (:codigo, :ref, :tipo, :categoria, :valor, :corretor, :status, :condominio,  "
                . ":taxaCond, :nchave, :napt, :cep, :rua, :numero, :cidade, :bairro, :zona, :obs)";
        $this->query($query);
        $this->bind(':codigo', $codigo);
        $this->bind(':ref', $ref);
        $this->bind(':tipo', $tipo);
        $this->bind(':categoria', $categoria);
        $this->bind(':valor', $valor);
        $this->bind(':corretor', $corretor);
        $this->bind(':status', $status);
        $this->bind(':condominio', $condominio);
        $this->bind(':taxaCond', $taxaCond);
        $this->bind(':nchave', $nchave);
        $this->bind(':napt', $napt);
        $this->bind(':cep', $cep);
        $this->bind(':rua', $rua);
        $this->bind(':numero', $numero);
        $this->bind(':cidade', $cidade);
        $this->bind(':bairro', $bairro);
        $this->bind(':zona', $zona);
        $this->bind(':obs', $obs);

        if ($this->execute()):

            // ID do imovel cadastrado
            $id_imovel = $this->lastInsertId();

            // Inserting Detalhes do Imovel
            $Detalhes = new Imovel\Detalhes_DAO();
            $Detalhes->insert($id_imovel, $detalhes);

            // Inserting Proprietarios do Imovel
            $Proprietarios = new Imovel\Proprietarios_DAO();
            $Proprietarios->insert($prop_imovel, $codigo);

            // Inserting Clientes do Imovel
            $Clientes = new Imovel\Locatarios_DAO();
            $Clientes->insert($locatario_imovel, $codigo);

            // Inserting no arquivo de log
            $url = URL_ROOT . "imovel/detalhes/{$codigo}";
            $url = "<a href='{$url}' target='blank'>{$codigo}</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Imóvel ({$url})");
        endif;
    }

    public function update()
    {
        $codigo_atual = Classes\FiltroInput::input($_POST['codigo_atual'], 'Código');
        $getImovelId = $this->get($codigo_atual);
        $id_imovel = $getImovelId['id'];
        $codigo_novo = Classes\FiltroInput::input($_POST['codigo'], 'Código');
        $ref = Classes\FiltroInput::ref($_POST['ref']);
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Tipo');
        $categoria = Classes\FiltroInput::input($_POST['categoria'], 'Categoria');
        $valor = nFormatDB($_POST['valor']);
        $corretor = Classes\FiltroInput::input($_POST['corretor'], 'Corretor');
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');
        $condominio = Classes\FiltroInput::input($_POST['condominio'], 'Condomínio/Edifício');
        $taxaCond = nFormatDB($_POST['taxaCond']);
        $nchave = Classes\FiltroInput::input($_POST['nchave'], 'Chave');
        $napt = Classes\FiltroInput::input($_POST['napt'], 'Nº Apt');
        $cep = Classes\FiltroInput::input($_POST['cep'], 'CEP');
        $rua = Classes\FiltroInput::input($_POST['rua'], 'Rua');
        $numero = $_POST['numero'];
        $cidade = Classes\FiltroInput::input($_POST['cidade'], 'Cidade');
        $bairro = Classes\FiltroInput::input($_POST['bairro'], 'Bairro');
        $zona = Classes\FiltroInput::input($_POST['zona'], 'Zona');
        $obs = addslashes($_POST['obs']);

        // Campos obrigatórios
        Classes\FiltroInput::campoVazio($codigo_novo, 'Código');
        Classes\FiltroInput::campoVazio($valor, 'Valor');
        //Classes\FiltroInput::campoVazio($rua, 'Rua');

        // Verifica Ref
        $this->query("SELECT codigo FROM imovel WHERE codigo != '{$codigo_atual}'");
        $this->execute();
        $result = $this->resultSet();
        foreach ($result as $imovel):
            if ($codigo_novo == $imovel['codigo']):
                array_push(Classes\FiltroInput::$Errors, "► Código já existe!<br />");
            endif;
        endforeach;


        if ($codigo_novo != $codigo_atual):
            // verificando pasta de imagens
            $pasta = $_SERVER['DOCUMENT_ROOT'] . '/spi/assets/img/imoveis/';
            if (file_exists($pasta . $codigo_atual)):
                rename($pasta . $codigo_atual, $pasta . $codigo_novo);
            endif;
            
            $query = "UPDATE ag_servicos SET codigo_imovel = '{$codigo_novo}' WHERE codigo_imovel = '{$codigo_atual}'";
            $query .= ";UPDATE ag_visitas SET codigo_imovel = '{$codigo_novo}' WHERE codigo_imovel = '{$codigo_atual}'";
            $this->query($query);
            $this->execute();
            
        endif;

        // Detalhes
        $detalhes = array(
            'matAgespisa' => Classes\FiltroInput::input($_POST['matAgespisa'], 'Mat. Agespisa'),
            'matEletrobras' => Classes\FiltroInput::input($_POST['matEletrobras'], 'Mat. Eletrobras'),
            'posicao' => Classes\FiltroInput::input($_POST['posicao'], 'Posição'),
            'topografia' => Classes\FiltroInput::input($_POST['topografia'], 'Topografia'),
            'iptu' => Classes\FiltroInput::input($_POST['iptu'], 'IPTU'),
            'valorIptu' => nFormatDB($_POST['valorIptu']),
            'areaUtil' => Classes\FiltroInput::input($_POST['areaUtil'], 'Área Util'),
            'areaTerreno' => Classes\FiltroInput::input($_POST['areaTerreno'], 'Área Terreno'),
            'areaConstruida' => Classes\FiltroInput::input($_POST['areaConstruida'], 'Área Construída'),
            'exclusividade' => Classes\FiltroInput::input($_POST['exclusividade'], 'Exclusividade'),
            'ocupacao' => Classes\FiltroInput::input($_POST['ocupacao'], 'Ocupação')
        );

        // proprietarios
        if (isset($_POST['proprietarios'])) {
            $prop_imovel = $_POST['proprietarios'];
        } else {
            $prop_imovel = array();
            array_push($prop_imovel, '');
        }

        // clientes
        if (isset($_POST['locatarios'])) {
            $locatario_imovel = $_POST['locatarios'];
        } else {
            $locatario_imovel = array();
            array_push($locatario_imovel, '');
        }

        // verificando errors
        new Classes\FiltroInput();

        // verificando pasta de imagens
        $pasta = $_SERVER['DOCUMENT_ROOT'] . '/spi/assets/img/imoveis/';
        if (file_exists($pasta . $codigo_atual)):
            rename($pasta . $codigo_atual, $pasta . $codigo_novo);
        endif;


        // Dados do Imovel
        $query = "UPDATE imovel SET codigo = :codigo, ref = :ref, tipo_id = :tipo, categoria_id = :categoria, valor = :valor, corretor_id = :corretor, "
                . "stats_id = :status, condominio = :condominio, taxaCond = :taxaCond, nchave = :nchave, napt = :napt, cep = :cep, "
                . "endereco = :rua, numero = :numero, cidade = :cidade, bairro = :bairro, zona = :zona, obs = :obs WHERE codigo = :codigoAtual";
        $this->query($query);
        $this->bind(':codigo', $codigo_novo);
        $this->bind(':ref', $ref);
        $this->bind(':tipo', $tipo);
        $this->bind(':categoria', $categoria);
        $this->bind(':valor', $valor);
        $this->bind(':corretor', $corretor);
        $this->bind(':status', $status);
        $this->bind(':condominio', $condominio);
        $this->bind(':taxaCond', $taxaCond);
        $this->bind(':nchave', $nchave);
        $this->bind(':napt', $napt);
        $this->bind(':cep', $cep);
        $this->bind(':rua', $rua);
        $this->bind(':numero', $numero);
        $this->bind(':cidade', $cidade);
        $this->bind(':bairro', $bairro);
        $this->bind(':zona', $zona);
        $this->bind(':obs', $obs);
        $this->bind(':codigoAtual', $codigo_atual);

        if ($this->execute()):

            // Updating Detalhes do Imovel
            $Detalhes = new Imovel\Detalhes_DAO();
            $Detalhes->update($id_imovel, $detalhes);

            // Inserting Proprietarios do Imovel
            $Proprietarios = new Imovel\Proprietarios_DAO();
            $Proprietarios->insert($prop_imovel, $codigo_novo);

            // Inserting Clientes do Imovel
            $Clientes = new Imovel\Locatarios_DAO();
            $Clientes->insert($locatario_imovel, $codigo_novo);

            // Inserting no arquivo de log
            $url = URL_ROOT . "imovel/detalhes/{$codigo_novo}";
            $url = "<a href='{$url}' target='blank'>{$codigo_novo}</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Imóvel ({$url})");
        endif;
    }

    public function delete()
    {
        $codigo = $_POST['codigo'];

        // Pegando ID do tipo "desabilitado"
        $query = "SELECT id FROM config_stats WHERE stats='DESABILITADO'";
        $this->query($query);
        $this->execute();
        $result = $this->result();
        $stats_id = $result['id'];

        $query = "UPDATE imovel SET stats_id = :stats_id, ref = :ref WHERE codigo = :codigo";
        $this->query($query);
        $this->bind(':ref', '');
        $this->bind(':stats_id', $stats_id);
        $this->bind(':codigo', $codigo);

        if ($this->execute()):
            // Inserindo no arquivo de log
            $url = URL_ROOT . "imovel/detalhes/{$codigo}";
            $url = "<a href='{$url}' target='blank'>{$codigo}</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Desabilitou um Imóvel ({$url})");
        endif;
    }

    public function enable()
    {
        $codigo = $_POST['codigo'];

        // Pegando ID do tipo "pendente"
        $this->query("SELECT id FROM config_stats WHERE stats='PENDENTE'");
        $this->execute();
        $result = $this->result();
        $stats_id = $result['id'];

        $query = "UPDATE imovel SET stats_id = :stats_id WHERE codigo = :codigo";
        $this->query($query);
        $this->bind(':stats_id', $stats_id);
        $this->bind(':codigo', $codigo);

        if ($this->execute()):
            // Inserindo no arquivo de log
            $url = URL_ROOT . "imovel/detalhes/{$codigo}";
            $url = "<a href='{$url}' target='blank'>{$codigo}</a>";
            $Log = new Classes\Log();
            $Log->sistema_log("Habilitou um Imóvel ({$url})");
        endif;
    }

    public function get($codigo = null)
    {
        if ($codigo === null):
            $codigo = _GetString('id');
        endif;

        $query = "SELECT * FROM vw_imoveis WHERE codigo = :codigo";
        $this->query($query);
        $this->bind(':codigo', $codigo);
        $this->execute();
        return $this->result();
    }

    public function getList()
    {
        /// WHERE
        $where = array();
        if (isset($_GET['c'])):
            if (_GetString('c') == '%'):

            else:
                $where[] = " categoria = '" . _GetString('c') . "'";
            endif;
        endif;
        if (isset($_GET['t'])):
            if (_GetString('t') == '%'):

            else:
                $where[] = " tipo = '" . _GetString('t') . "'";
            endif;
        endif;
        if (isset($_GET['s'])):
            if (_GetString('s') == '%'):
                $where[] = " stats != 'DESABILITADO'"; // PARA NAO MOSTRAR DESABILITADOS
            else:
                $where[] = " stats = '" . _GetString('s') . "'";
            endif;
        else:
            $where[] = " stats != 'DESABILITADO' AND stats != 'LOCADO'"; // PARA NAO MOSTRAR DESABILITADOS
        endif;

        $query = "SELECT * FROM vw_imoveis";
        $this->query($query);
        $this->execute();
        $total_linhas = $this->numRows();

        //$paginacao = Classes\Paginacao::setPaginacao();
        // acrescentando Where
        if (count($where)):
            $query .= " WHERE" . implode(" AND ", $where);
        endif;

        // acrescentando Order by
        if (isset($_GET['orderby'])):
            $order = _GetString('orderby');
            (isset($_GET['o'])) ? $ordem = _GetString('o') : $ordem = "ASC";

            $query .= " ORDER BY " . $order . ' ' . $ordem;
        endif;

        $this->query($query);
        $this->execute();
        Classes\Paginacao::totalPaginas($this->numRows());

        // acrescentando Limit
        // $query .= " LIMIT $paginacao";
        $this->query($query);
        $this->execute();

        return array(
            $this->resultset(),
            $total_linhas
        );
    }

    public function getLastCodigo()
    {
        $query = "SELECT codigo FROM vw_imoveis WHERE tipo = 'ALUGUEL' ORDER BY id DESC LIMIT 0,1";
        $this->query($query);
        $this->execute();
        $codigo_aluguel = $this->result();

        if (empty($codigo_aluguel['codigo'])):
            $aluguel = 'L0001';
        else:
            $codigo_aluguel = explode('L', $codigo_aluguel['codigo']);
            if (count($codigo_aluguel) > 1):
                $aluguel = (int) $codigo_aluguel[1] + 1;
                $aluguel = 'L' . str_pad($aluguel, 4, 0, STR_PAD_LEFT);
            else:
                $aluguel = 'L0001';
            endif;

        endif;

        $query = "SELECT codigo FROM vw_imoveis WHERE tipo = 'VENDA' ORDER BY id DESC LIMIT 0,1";
        $this->query($query);
        $this->execute();
        $codigo_venda = $this->result();

        if (empty($codigo_venda['codigo'])):

        else:
            $codigo_venda = explode('V', $codigo_venda['codigo']);
            if (count($codigo_venda) > 1):
                $venda = (int) $codigo_venda[1] + 1;
                $venda = 'V' . str_pad($venda, 4, 0, STR_PAD_LEFT);
            else:
                $venda = 'V0001';
            endif;

        endif;

        return array('venda' => $venda, 'aluguel' => $aluguel);
    }

    public function search()
    {
        $busca = $_GET['search'];

        $query = "SELECT * FROM vw_imoveis WHERE (codigo LIKE '%$busca%' OR ref LIKE '%$busca%' OR bairro LIKE '%$busca%' OR endereco LIKE '%$busca%' OR zona LIKE '$busca%' "
                . "OR categoria LIKE '$busca%' OR tipo LIKE '$busca%' OR cidade LIKE '$busca%' OR cep LIKE '$busca%' OR condominio LIKE '%$busca%' "
                . "OR valor LIKE '%$busca%') AND stats NOT IN('DESABILITADO')";
        $this->query($query);
        $this->execute();
        return $this->resultSet();
    }

    public function searchGet()
    {
        $busca = $_POST['busca'];
        $tipoSet = $_POST['tipoSet'];

        $query = "SELECT * FROM vw_imoveis WHERE (codigo LIKE '%$busca%' OR ref LIKE '$busca%' OR bairro LIKE '%$busca%' OR endereco LIKE '%$busca%' OR zona LIKE '$busca%' "
                . "OR categoria LIKE '$busca%' OR tipo LIKE '$busca%' OR cidade LIKE '$busca%' OR cep LIKE '$busca%' OR condominio LIKE '%$busca%' "
                . "OR valor LIKE '%$busca%') AND stats NOT IN('DESABILITADO')";
        $this->query($query);
        $this->execute();
        $result = $this->resultSet();
        $linha = $this->numRows();
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-unbordered">
                <thead>
                <th>Código</th>
                <th>Ref.</th>
                <th>Endereço</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Status</th>
                </thead>
                <tbody>
                    <?php
                    if ($linha == 0) {
                        echo "<tr><td>Nenhum imóvel encontrado. </td><td></td><td></td><td></td></tr>";
                    } else {
                        foreach ($result as $imovel) {
                            $codigo = $imovel['codigo'];
                            $ref = $imovel['ref'];
                            $endereco = mb_ucwords($imovel['endereco']);
                            $bairro = mb_ucwords($imovel['bairro']);
                            $numero = Classes\CamposDefault::numero($imovel['numero']);

                            $cidade = mb_ucwords($imovel['cidade']);
                            $zona = mb_ucwords($imovel['zona']);
                            $cep = $imovel['cep'];
                            $tipo = mb_ucwords($imovel['tipo']);
                            $categoria = mb_ucwords($imovel['categoria']);
                            $status = mb_ucwords($imovel['stats']);
                            ?>
                            <tr style="cursor:pointer" data-dismiss="modal" onClick="<?= $tipoSet; ?>('<?= $codigo ?>')">
                                <td><?= $codigo; ?></td>
                                <td><?= $ref; ?></td>
                                <td><?= $endereco . ", " . $numero . " - " . $bairro . " - " . $zona . " - " . $cidade . " - " . $cep; ?></td>
                                <td><?= $tipo; ?></td>
                                <td><?= $categoria; ?></td>
                                <td><?= $status ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }

}
