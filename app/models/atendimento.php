<?php

namespace App\Models;

use Lib\Base as Base;
use Lib\Classes as Classes;
use Lib\Interfaces as Interfaces;

/**
 * Description of atendimento
 *
 * @author Thalisson
 */
class Atendimento extends Base\Model implements Interfaces\CRUD
{

    public function Index()
    {
        return;
    }

    /*
     * Cadastrar Atendimento
     */

    public function insert()
    {

        $nome = Classes\FiltroInput::input($_POST['at_nome'], 'Nome');

        $email = Classes\FiltroInput::email($_POST['at_email']);
        $tel = Classes\FiltroInput::input($_POST['at_tel'], 'Telefone');
        $tel_comercial = Classes\FiltroInput::input($_POST['at_tel_comercial'], 'Telefone Comercial');
        $conheceu = Classes\FiltroInput::input($_POST['at_conheceu'], 'Como Conheceu');
        $tipo = Classes\FiltroInput::input($_POST['at_imovel_tipo'], 'Tipo');
        $obs = addslashes($_POST['at_obs']);
        $usuario = $_SESSION['user']['nome'];
        $interesse = $_POST['at_interesse'];
        $zona_selected = $_POST['at_imovel_zona'];
        $imovel_categoria_selected = $_POST['at_imovel_categoria'];
        $valor_de = nFormatDB($_POST['at_imovel_valor_de']);
        $valor_ate = nFormatDB(($_POST['at_imovel_valor_ate']));

        // campos obrigatórios
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        if ($interesse == "Imóvel") {

            Classes\FiltroInput::campoVazio($zona_selected, 'Zona');
            Classes\FiltroInput::campoVazio($imovel_categoria_selected, 'Imóvel Categoria');
            Classes\FiltroInput::campoVazio($valor_ate, 'Valor Até');
        }

        // Verificando errors
        new Classes\FiltroInput();

        $data = date('Y-m-d H:i:s');

        // Colocando Interesses em um array
        $imovel_categoria = "";
        foreach ($imovel_categoria_selected as $value) {
            $imovel_categoria .= mb_ucwords($value) . " - ";
        }
        // Colocando Zonas em um array
        $zona = "";
        foreach ($zona_selected as $value) {
            $zona .= mb_ucwords($value) . " - ";
        }

        // Inserindo atendimento
        $query = "INSERT INTO cl_atendimentos(nome,email, tel, tel_comercial, conheceu, tipo, interesse, imovel_categoria, valor_de, valor_ate, zona, obs, usuario, data) "
                . "VALUES (:nome, :email, :tel, :tel_comercial, :conheceu, :tipo, :interesse, :imovel_categoria, :valor_de, :valor_ate, :zona, :obs, :usuario, :data)";
        $this->query($query);
        $this->bind(':nome', $nome);
        $this->bind(':email', $email);
        $this->bind(':tel', $tel);
        $this->bind(':tel_comercial', $tel_comercial);
        $this->bind(':conheceu', $conheceu);
        $this->bind(':tipo', $tipo);
        $this->bind(':interesse', $interesse);
        $this->bind(':imovel_categoria', $imovel_categoria);
        $this->bind(':valor_de', $valor_de);
        $this->bind(':valor_ate', $valor_ate);
        $this->bind(':zona', $zona);
        $this->bind(':obs', $obs);
        $this->bind(':usuario', $usuario);
        $this->bind(':data', $data);
        $this->execute();
        $last_id = $this->lastInsertId();

        if (!empty($last_id)):
            // Inserindo no arquivo de log
            $link = 'atendimento/detalhes/' . $last_id;
            $Log = new Classes\Log();
            $Log->sistema_log("Cadastrou um Atendimento(<a href={$link}>$last_id</a>)");
        endif;
    }

    /*
     * Editar Atendimento
     */

    public function update()
    {
        $id = (int) $_POST['id'];
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        $email = Classes\FiltroInput::email($_POST['email']);
        $tel = Classes\FiltroInput::input($_POST['tel'], 'Telefone');
        $tel_comercial = Classes\FiltroInput::input($_POST['tel_comercial'], 'Telefone Comercial');
        $conheceu = Classes\FiltroInput::input($_POST['conheceu'], 'Como Conheceu');
        $obs = addslashes($_POST['obs']);
        $interesse = $_POST['interesse'];

        if ($interesse == "Imóvel") {
            $tipo = Classes\FiltroInput::input($_POST['imovel_tipo'], 'Tipo');
            $imovel_categoria_selected = $_POST['imovel_categoria'];
            $zona_selected = $_POST['imovel_zona'];
            $valor_de = \nFormatDB($_POST['imovel_valor_de']);
            $valor_ate = \nFormatDB($_POST['imovel_valor_ate']);
        } else {
            $tipo = "";
            $imovel_categoria_selected = array();
            $zona_selected = array();
            $valor_de = 0.00;
            $valor_ate = 0.00;
        }


        // Campos Obrigatórios
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        if ($interesse == "Imóvel") {
            Classes\FiltroInput::campoVazio($zona_selected, 'Zona');
            Classes\FiltroInput::campoVazio($imovel_categoria_selected, 'Categoria');
            Classes\FiltroInput::campoVazio($valor_ate, 'Valor Até');
        }

        // Juntando array de Interesses
        $imovel_categoria = "";
        foreach ($imovel_categoria_selected as $value) {
            $imovel_categoria .= mb_ucwords($value) . " - ";
        }
        // Juntando array de Zonas
        $zona = ""; // variavel que irá para o banco
        foreach ($zona_selected as $value) {
            $zona .= mb_ucwords($value) . " - ";
        }

        // Verificando array de Errors
        new Classes\FiltroInput();

        // Update no banco
        $query = "UPDATE cl_atendimentos SET nome = :nome, email = :email, tel = :tel, tel_comercial = :tel_comercial, conheceu = :conheceu, "
                . "tipo = :tipo, interesse = :interesse, imovel_categoria = :imovel_categoria, valor_de = :valor_de, valor_ate = :valor_ate, zona = :zona, obs = :obs WHERE id = :id";
        $this->query($query);
        $this->bind(':nome', $nome);
        $this->bind(':email', $email);
        $this->bind(':tel', $tel);
        $this->bind(':tel_comercial', $tel_comercial);
        $this->bind(':conheceu', $conheceu);
        $this->bind(':tipo', $tipo);
        $this->bind(':interesse', $interesse);
        $this->bind(':imovel_categoria', $imovel_categoria);
        $this->bind(':valor_de', $valor_de);
        $this->bind(':valor_ate', $valor_ate);
        $this->bind(':zona', $zona);
        $this->bind(':obs', $obs);
        $this->bind(':id', $id);
        $result = $this->execute();

        if ($result) {
            // Inserindo no arquivo de log
            $link = 'atendimento/detalhes/' . $id;
            $Log = new Classes\Log();
            $Log->sistema_log("Editou um Atendimento(<a href={$link}>$id</a>)", $_SESSION['user']['nome']);
        }
    }

    /*
     * Excluir atendimento
     */

    public function delete()
    {

        $query = "DELETE FROM cl_atendimentos WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $_POST['idAtendimento']);
        $result = $this->execute();

        if ($result) {
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Atendimento ({$_POST['idAtendimento']})", $_SESSION['user']['nome']);
        }
    }

    /*
     * Buscar Atendimento
     */

    public function search()
    {
        $nome = $_POST['nome'];
        $zona = $_POST['zona'];
        $categoria = $_POST['categoria'];

        $where = array();
        // Verificando qual foi a pesquisa
        if ($nome != "") {
            $where[] = " nome LIKE '%{$nome}%'";
        }
        if ($zona != " ") {
            $where[] = " (zona LIKE '%{$zona}%' OR zona like '%qualquer%')";
        }

        if ($categoria != " ") {
            $where[] = " interesse LIKE '%{$categoria}%'";
        }

        $query = "SELECT * FROM cl_atendimentos";
        $this->query($query);
        $this->execute();
        $total_linhas = $this->numRows();

        $paginacao = Classes\Paginacao::setPaginacao();
        Classes\Paginacao::totalPaginas($total_linhas);

        if ($where == true) {
            $query .= " WHERE" . implode(" AND ", $where);
        }
        $query .= " ORDER BY data DESC LIMIT $paginacao";

        $this->query($query);
        $this->execute();
        $result = $this->resultSet();
        ?>
        <div id="lista">
            <table>
                <thead style="height: 50px;">
                <th>Nº<th>Cliente<th>Telefone<th>Interesse<th>Zona<th>Data         
                    </thead> 
                    <?php
                    if ($this->numRows() == 0) {
                        echo "<td>Nenhum cliente encontrado.</td><td></td><td></td><td></td><td></td><td></td><td></td>";
                    } else {
                        foreach ($result as $atendimento) {

                            $date = date_format(new \DateTime($atendimento['data']), 'd/m/Y H:i');
                            $date = explode(" ", $date);
                            ?>
                        <tr onClick="javascript: window.location.href = '<?= URL_ROOT; ?>atendimento/detalhes/<?= $atendimento['id'] ?>'">
                            <td style="width: auto;" class="verde" >#<?= str_pad($atendimento['id'], 4, 0, STR_PAD_LEFT) ?></td>
                            <td><?= mb_ucwords($atendimento['nome']); ?></td>
                            <td><?= $atendimento['tel']; ?></td>
                            <td><?= substr($atendimento['interesse'], 0, strlen($atendimento['interesse']) - 2); ?></td>
                            <td><?= substr($atendimento['zona'], 0, strlen($atendimento['zona']) - 2); ?></td>
                            <td ><?= $date[0] . " às " . $date[1]; ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                </table>
            </div>
            <?php
        }
    }

    /*
     * Detalhes do atendimento
     */

    public function get($id = null)
    {
        // Pegando ID
        if ($id === null):
            $id = _GetInt('id');
        else:
            $id = $id;
        endif;

        // Consultando no Banco
        $query = "SELECT * FROM cl_atendimentos WHERE id = :id";
        $this->query($query);
        $this->bind(":id", $id);
        $this->execute();
        return $this->result();
    }

    /*
     * Lista de Atendimentos - Página Index
     */

    public function getList($limite = null)
    {

//        if ($limite != null):
//            Classes\Paginacao::$total_reg = $limite;
//        endif;
//        
//        $paginacao = Classes\Paginacao::setPaginacao();
//        
//        // Total sem limit
//        $query = "SELECT id FROM cl_atendimentos";
//        $this->query($query);
//        $this->execute();
//        $total_linhas = $this->numRows();
//        
//        Classes\Paginacao::totalPaginas($total_linhas);

        $query = "SELECT * FROM cl_atendimentos ORDER BY id DESC";
        $this->query($query);
        $this->execute();
        return $this->resultSet();
    }

    /*
     * Lista de Possíveis Imoveis - Página de Detalhes
     */

    public function listaPossiveisImoveis()
    {

        // Pegando ID
        $id = _GetInt('id');

        // Consultando no Banco
        $query = "SELECT * FROM cl_atendimentos WHERE id = :id";
        $this->query($query);
        $this->bind(":id", $id);
        $this->execute();
        $atendimento = $this->result();

        $interesse = substr($atendimento['imovel_categoria'], 0, strlen($atendimento['imovel_categoria']) - 2);
        $zona = substr($atendimento['zona'], 0, strlen($atendimento['zona']) - 2);


        // Definindo um valor a mais para procurar
        $valor_ate = 0.00;
        if ($atendimento['tipo'] == "Aluguel"):
            $valor_ate = $atendimento['valor_ate'] + 200;
        elseif ($atendimento['tipo'] == "Venda"):
            $valor_ate = $atendimento['valor_ate'] + 20.000;
        endif;

        // Colocando array de Interesses
        $interesse = explode(" - ", $interesse);
        // Criando a string para comparação na QUERY
        $lista_interesse = "";
        foreach ($interesse as $item) {
            $lista_interesse .= "'{$item}' , ";
        }
        $lista_interesse .= "' '";

        // Colocando array de Zonas
        $zona = explode(" - ", $zona);
        $lista_zona = "";
        foreach ($zona as $item) {
            $lista_zona .= "'{$item}',";
        }
        $lista_zona .= "' '";


        // Checando se são todas as zonas
        if ($zona[0] == "Qualquer ") {
            $zona_query = "";
        } else {
            $zona_query = "AND zona IN ($lista_zona)";
        }

        // Query para buscar Imóveis de Interesse

        $query = "SELECT * FROM vw_imoveis "
                . "WHERE categoria IN ($lista_interesse) "
                . "AND tipo = :tipo "
                . "AND valor BETWEEN {$atendimento['valor_de']} AND {$valor_ate} "
                . "{$zona_query} "
                . "AND stats NOT IN ('DESABILITADO', 'LOCADO') "
                . "ORDER BY valor ASC";
        $this->query($query);
        $this->bind(":tipo", $atendimento['tipo']);
        $this->execute();
        return $this->resultSet();
    }

}
