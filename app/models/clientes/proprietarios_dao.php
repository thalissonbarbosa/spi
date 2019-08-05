<?php

namespace App\Models\Clientes;

use App\Models\Imovel as Imovel;
use Lib\Base as Base;
use Lib\Classes as Classes;
use Lib\Interfaces as Interfaces;

/**
 * Description of proprietarios_DAO
 *
 * @author Thalisson
 */
class Proprietarios_DAO extends Base\Model implements Interfaces\CRUD
{

    public function insert()
    {
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Tipo');
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $cpf = Classes\FiltroInput::input($_POST['cpf'], 'CPF');
        $rg = Classes\FiltroInput::input($_POST['rg'], 'RG');
        $data_nasc = Classes\FiltroInput::data($_POST['data_nasc'], 'Data Nascimento');
        $estado_civil = Classes\FiltroInput::input($_POST['estado_civil'], 'Estado Civil');
        $contato = Classes\FiltroInput::input($_POST['contato'], 'Contato');
        $email = Classes\FiltroInput::email($_POST['email']);
        $declarante = Classes\FiltroInput::input($_POST['declarante'], 'Declarante');
        $representante = Classes\FiltroInput::input($_POST['representante'], 'Representante');
        $rep_contato = Classes\FiltroInput::input($_POST['rep_contato'], 'Contato Representante');
        $rep_email = Classes\FiltroInput::email($_POST['rep_email']);

        $cep = Classes\FiltroInput::input($_POST['cep'], 'CEP');
        $rua = Classes\FiltroInput::input($_POST['rua'], 'Rua');
        $numero = $_POST['numero'];
        $cidade = Classes\FiltroInput::input($_POST['cidade'], 'Cidade');
        $bairro = Classes\FiltroInput::input($_POST['bairro'], 'Bairro');
        $zona = Classes\FiltroInput::input($_POST['zona'], 'Zona');
        $endereco = $rua . " , " . $numero . " , " . $bairro . " , " . $cep . " , " . $zona . " , " . $cidade;
        $complemento = addslashes($_POST['complemento']);

        $profissao = Classes\FiltroInput::input($_POST['profissao'], 'Profissional > Profissão');
        $prof_firma = Classes\FiltroInput::input($_POST['prof_firma'], 'Profissional > Firma');
        $prof_funcao = Classes\FiltroInput::input($_POST['prof_funcao'], 'Profissional > Função');
        $prof_telefone = Classes\FiltroInput::input($_POST['prof_telefone'], 'Profissional > Telefone');

        $prof_cep = Classes\FiltroInput::input($_POST['prof_cep'], 'Profissional > CEP');
        $prof_rua = Classes\FiltroInput::input($_POST['prof_rua'], 'Profissional > Rua');
        $prof_numero = Classes\FiltroInput::input($_POST['prof_numero'], 'Profissional > Número');
        $prof_cidade = Classes\FiltroInput::input($_POST['prof_cidade'], 'Profissional > Cidade');
        $prof_bairro = Classes\FiltroInput::input($_POST['prof_bairro'], 'Profissional > Bairro');
        $prof_zona = Classes\FiltroInput::input($_POST['prof_zona'], 'Profissional > Zona');
        $prof_endereco = $prof_rua . " , " . $prof_numero . " , " . $prof_bairro . " , " . $prof_cep . " , " . $prof_zona . " , " . $prof_cidade;

        $conjuge = Classes\FiltroInput::input($_POST['conj_nome'], 'Cônjuge > Nome');
        $conj_nasc = Classes\FiltroInput::data($_POST['conj_nasc'], 'Cônjuge > Data Nascimento');
        $conj_rg = Classes\FiltroInput::input($_POST['conj_rg'], 'Cônjuge > RG');
        $conj_cpf = Classes\FiltroInput::input($_POST['conj_cpf'], 'Cônjuge > CPF');
        $conj_profissao = Classes\FiltroInput::input($_POST['conj_prof'], 'Cônjuge > Profissão');
        
        $empresa_cnpj = Classes\FiltroInput::input($_POST['empresa_cnpj'], 'Empresa > CNPJ');
        $empresa_inscricao_estadual = Classes\FiltroInput::input($_POST['empresa_inscricao_estadual'], 'Empresa > Inscrição Estadual');
        $empresa_razao_social = Classes\FiltroInput::input($_POST['empresa_razao_social'], 'Empresa > Razão Social');
        $empresa_nome = Classes\FiltroInput::input($_POST['empresa_nome_fantasia'], 'Empresa > Nome Fantasia');
        $empresa_ramo = Classes\FiltroInput::input($_POST['empresa_ramo'], 'Empresa > Ramo de Atividade');
        $empresa_sede = Classes\FiltroInput::input($_POST['empresa_sede'], 'Empresa > Sede');
        $empresa_data_abertura = Classes\FiltroInput::data($_POST['empresa_data_abertura'], 'Empresa > Data de Abertura');
        $empresa_controle_acionario = Classes\FiltroInput::input($_POST['empresa_controle_acionario'], 'Empresa > Controle Acionário');
        $empresa_capital_aberto = Classes\FiltroInput::input($_POST['empresa_capital_aberto'], 'Empresa > Capital Aberto');
        $empresa_capital = nFormatDB($_POST['empresa_capital_social']);
        $empresa_contato = Classes\FiltroInput::input($_POST['empresa_contato'], 'Empresa > Contato');
        $empresa_email = Classes\FiltroInput::input($_POST['empresa_email'], 'Empresa > Email');
        $empresa_cep = Classes\FiltroInput::input($_POST['empresa_cep'], 'Empresa > CEP');
        $empresa_rua = Classes\FiltroInput::input($_POST['empresa_rua'], 'Empresa > Rua');
        $empresa_numero = Classes\FiltroInput::input($_POST['empresa_numero'], 'Empresa > Número');
        $empresa_bairro = Classes\FiltroInput::input($_POST['empresa_bairro'], 'Empresa > Bairro');
        $empresa_zona = Classes\FiltroInput::input($_POST['empresa_zona'], 'Empresa > Zona');
        $empresa_cidade = Classes\FiltroInput::input($_POST['empresa_cidade'], 'Empresa > Cidade');

        // Verificando errors
        new Classes\FiltroInput();

        // Inserindo o Prprietario no banco
        $query = "INSERT INTO cl_proprietarios(tipo, nome, cpf, rg, endereco, complemento, data_nasc, estado_civil, contato, email, declarante, representante, "
                . "rep_contato,rep_email, profissao, prof_firma, prof_endereco, prof_funcao, prof_telefone, conjuge, conj_nasc, conj_rg, conj_cpf, "
                . "conj_profissao, status) "
                . "values (:tipo, :nome, :cpf, :rg, :endereco, :complemento, :data_nasc, :estado_civil, :contato, :email, :declarante, :representante, :rep_contato, "
                . ":rep_email, :profissao, :prof_firma, :prof_endereco, :prof_funcao, :prof_telefone, :conjuge, :conj_nasc, :conj_rg, :conj_cpf, "
                . ":conj_profissao, :status)";
        $this->query($query);
        $this->bind(':tipo', $tipo);
        $this->bind(':nome', $nome);
        $this->bind(':cpf', $cpf);
        $this->bind(':rg', $rg);
        $this->bind(':endereco', $endereco);
        $this->bind(':complemento', $complemento);
        $this->bind(':data_nasc', $data_nasc);
        $this->bind(':estado_civil', $estado_civil);
        $this->bind(':contato', $contato);
        $this->bind(':email', $email);
        $this->bind(':declarante', $declarante);
        $this->bind(':representante', $representante);
        $this->bind(':rep_contato', $rep_contato);
        $this->bind(':rep_email', $rep_email);
        $this->bind(':profissao', $profissao);
        $this->bind(':prof_firma', $prof_firma);
        $this->bind(':prof_endereco', $prof_endereco);
        $this->bind(':prof_funcao', $prof_funcao);
        $this->bind(':prof_telefone', $prof_telefone);
        $this->bind(':conjuge', $conjuge);
        $this->bind(':conj_nasc', $conj_nasc);
        $this->bind(':conj_rg', $conj_rg);
        $this->bind(':conj_cpf', $conj_cpf);
        $this->bind(':conj_profissao', $conj_profissao);
        $this->bind(':status', $status);
        $this->execute();
        // Pegando ID do proprietario cadastrado
        $id_proprietario = $this->lastInsertId();

        // Se for pessoa jurídica, inserir dados na tabela locatario_empresa
        if ($tipo == 'Jurídica'):

            $query = "INSERT INTO cl_proprietarios_empresa (cl_proprietarios_id, cnpj, inscricao_estadual, razao_social, nome_fantasia, ramo, sede, "
                    . "data_abertura, controle_acionario, capital_aberto, capital_social, contato, email, cep, rua, numero, bairro, zona, cidade)"
                    . "VALUES (:proprietario_id, :cnpj, :inscricao_estadual, :razao_social, :nome_fantasia, :ramo, :sede, :data_abertura, "
                    . ":controle_acionario, :capital_aberto, :capital_social, :contato, :email, :cep, :rua, :numero, :bairro, :zona, :cidade)";
            $this->query($query);
            $this->bind(':proprietario_id', $id_proprietario);
            $this->bind(':cnpj', $empresa_cnpj);
            $this->bind(':inscricao_estadual', $empresa_inscricao_estadual);
            $this->bind(':razao_social', $empresa_razao_social);
            $this->bind(':nome_fantasia', $empresa_nome);
            $this->bind(':ramo', $empresa_ramo);
            $this->bind(':sede', $empresa_sede);
            $this->bind(':data_abertura', $empresa_data_abertura);
            $this->bind(':controle_acionario', $empresa_controle_acionario);
            $this->bind(':capital_aberto', $empresa_capital_aberto);
            $this->bind(':capital_social', $empresa_capital);
            $this->bind(':contato', $empresa_contato);
            $this->bind(':email', $empresa_email);
            $this->bind(':cep', $empresa_cep);
            $this->bind(':rua', $empresa_rua);
            $this->bind(':numero', $empresa_numero);
            $this->bind(':bairro', $empresa_bairro);
            $this->bind(':zona', $empresa_zona);
            $this->bind(':cidade', $empresa_cidade);
            $this->execute();

        endif;
        
        $Proprietarios = new Imovel\Proprietarios_DAO();
        // Verificando se há imoveis no array
        if (isset($_POST['imovel'])):
            // Inserindo cada imovel no array na tabela de proprietarios do imovel
            foreach ($_POST['imovel'] as $ref):
                $Proprietarios->insert(array($id_proprietario), $ref);
            endforeach;
        endif;

        // Inserindo no arquivo de log
        $url = URL_ROOT . "clientes/proprietarios/editar?p=" . $id_proprietario;
        $url = "<a href='{$url}' target='blank'>$id_proprietario</a>";
        $Log = new Classes\Log();
        $Log->sistema_log("Cadastrou um Proprietário($url)");
    }

    public function update()
    {
        $id = (int) $_POST['id'];
        $tipo = Classes\FiltroInput::input($_POST['tipo'], 'Tipo');
        $nome = Classes\FiltroInput::input($_POST['nome'], 'Nome');
        Classes\FiltroInput::campoVazio($nome, 'Nome');
        $cpf = Classes\FiltroInput::input($_POST['cpf'], 'CPF');
        $rg = Classes\FiltroInput::input($_POST['rg'], 'RG');
        $data_nasc = Classes\FiltroInput::data($_POST['data_nasc'], 'Data Nascimento');
        $estado_civil = Classes\FiltroInput::input($_POST['estado_civil'], 'Estado Civil');
        $contato = Classes\FiltroInput::input($_POST['contato'], 'Contato');
        $email = Classes\FiltroInput::email($_POST['email']);
        $declarante = Classes\FiltroInput::input($_POST['declarante'], 'Declarante');
        $representante = Classes\FiltroInput::input($_POST['representante'], 'Representante');
        $rep_contato = Classes\FiltroInput::input($_POST['rep_contato'], 'Contato Representante');
        $rep_email = Classes\FiltroInput::email($_POST['rep_email']);
        
        $cep = Classes\FiltroInput::input($_POST['cep'], 'CEP');
        $rua = Classes\FiltroInput::input($_POST['rua'], 'Rua');
        $numero = $_POST['numero'];
        $cidade = Classes\FiltroInput::input($_POST['cidade'], 'Cidade');
        $bairro = Classes\FiltroInput::input($_POST['bairro'], 'Bairro');
        $zona = Classes\FiltroInput::input($_POST['zona'], 'Zona');
        $endereco = $rua . " , " . $numero . " , " . $bairro . " , " . $cep . " , " . $zona . " , " . $cidade;
        $complemento = addslashes($_POST['complemento']);
        
        $status = Classes\FiltroInput::input($_POST['status'], 'Status');

        $profissao = Classes\FiltroInput::input($_POST['profissao'], 'Profissional > Profissão');
        $prof_firma = Classes\FiltroInput::input($_POST['prof_firma'], 'Profissional > Firma');
        $prof_funcao = Classes\FiltroInput::input($_POST['prof_funcao'], 'Profissional > Função');
        $prof_telefone = Classes\FiltroInput::input($_POST['prof_telefone'], 'Profissional > Telefone');

        $prof_cep = Classes\FiltroInput::input($_POST['prof_cep'], 'Profissional > CEP');
        $prof_rua = Classes\FiltroInput::input($_POST['prof_rua'], 'Profissional > Rua');
        $prof_numero = Classes\FiltroInput::input($_POST['prof_numero'], 'Profissional > Número');
        $prof_cidade = Classes\FiltroInput::input($_POST['prof_cidade'], 'Profissional > Cidade');
        $prof_bairro = Classes\FiltroInput::input($_POST['prof_bairro'], 'Profissional > Bairro');
        $prof_zona = Classes\FiltroInput::input($_POST['prof_zona'], 'Profissional > Zona');
        $prof_endereco = $prof_rua . " , " . $prof_numero . " , " . $prof_bairro . " , " . $prof_cep . " , " . $prof_zona . " , " . $prof_cidade;

        $conjuge = Classes\FiltroInput::input($_POST['conj_nome'], 'Cônjuge > Nome');
        $conj_nasc = Classes\FiltroInput::data($_POST['conj_nasc'], 'Cônjuge > Data Nascimento');
        $conj_rg = Classes\FiltroInput::input($_POST['conj_rg'], 'Cônjuge > RG');
        $conj_cpf = Classes\FiltroInput::input($_POST['conj_cpf'], 'Cônjuge > CPF');
        $conj_profissao = Classes\FiltroInput::input($_POST['conj_prof'], 'Cônjuge > Profissão');

        $empresa_cnpj = Classes\FiltroInput::input($_POST['empresa_cnpj'], 'Empresa > CNPJ');
        $empresa_inscricao_estadual = Classes\FiltroInput::input($_POST['empresa_inscricao_estadual'], 'Empresa > Inscrição Estadual');
        $empresa_razao_social = Classes\FiltroInput::input($_POST['empresa_razao_social'], 'Empresa > Razão Social');
        $empresa_nome = Classes\FiltroInput::input($_POST['empresa_nome_fantasia'], 'Empresa > Nome Fantasia');
        $empresa_ramo = Classes\FiltroInput::input($_POST['empresa_ramo'], 'Empresa > Ramo de Atividade');
        $empresa_sede = Classes\FiltroInput::input($_POST['empresa_sede'], 'Empresa > Sede');
        $empresa_data_abertura = Classes\FiltroInput::data($_POST['empresa_data_abertura'], 'Empresa > Data de Abertura');
        $empresa_controle_acionario = Classes\FiltroInput::input($_POST['empresa_controle_acionario'], 'Empresa > Controle Acionário');
        $empresa_capital_aberto = Classes\FiltroInput::input($_POST['empresa_capital_aberto'], 'Empresa > Capital Aberto');
        $empresa_capital = nFormatDB($_POST['empresa_capital_social']);
        $empresa_contato = Classes\FiltroInput::input($_POST['empresa_contato'], 'Empresa > Contato');
        $empresa_email = Classes\FiltroInput::input($_POST['empresa_email'], 'Empresa > Email');
        $empresa_cep = Classes\FiltroInput::input($_POST['empresa_cep'], 'Empresa > CEP');
        $empresa_rua = Classes\FiltroInput::input($_POST['empresa_rua'], 'Empresa > Rua');
        $empresa_numero = Classes\FiltroInput::input($_POST['empresa_numero'], 'Empresa > Número');
        $empresa_bairro = Classes\FiltroInput::input($_POST['empresa_bairro'], 'Empresa > Bairro');
        $empresa_zona = Classes\FiltroInput::input($_POST['empresa_zona'], 'Empresa > Zona');
        $empresa_cidade = Classes\FiltroInput::input($_POST['empresa_cidade'], 'Empresa > Cidade');
        
        // verificando errors
        new Classes\FiltroInput();

        // Inserindo o Prprietario no banco
        $query = "UPDATE cl_proprietarios SET tipo = :tipo, nome = :nome, cpf = :cpf, rg = :rg, endereco = :endereco, complemento = :complemento, "
                . "data_nasc = :data_nasc, estado_civil = :estado_civil, contato = :contato, email = :email, declarante = :declarante, representante = :representante, "
                . "rep_contato = :rep_contato, rep_email = :rep_email, profissao = :profissao, prof_firma = :prof_firma, prof_endereco = :prof_endereco, "
                . "prof_funcao = :prof_funcao, prof_telefone = :prof_telefone, conjuge = :conjuge, conj_nasc = :conj_nasc, conj_rg = :conj_rg, "
                . "conj_cpf = :conj_cpf, conj_profissao = :conj_profissao, status = :status WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->bind(':tipo', $tipo);
        $this->bind(':nome', $nome);
        $this->bind(':cpf', $cpf);
        $this->bind(':rg', $rg);
        $this->bind(':endereco', $endereco);
        $this->bind(':complemento', $complemento);
        $this->bind(':data_nasc', $data_nasc);
        $this->bind(':estado_civil', $estado_civil);
        $this->bind(':contato', $contato);
        $this->bind(':email', $email);
        $this->bind(':declarante', $declarante);
        $this->bind(':representante', $representante);
        $this->bind(':rep_contato', $rep_contato);
        $this->bind(':rep_email', $rep_email);
        $this->bind(':profissao', $profissao);
        $this->bind(':prof_firma', $prof_firma);
        $this->bind(':prof_endereco', $prof_endereco);
        $this->bind(':prof_funcao', $prof_funcao);
        $this->bind(':prof_telefone', $prof_telefone);
        $this->bind(':conjuge', $conjuge);
        $this->bind(':conj_nasc', $conj_nasc);
        $this->bind(':conj_rg', $conj_rg);
        $this->bind(':conj_cpf', $conj_cpf);
        $this->bind(':conj_profissao', $conj_profissao);
        $this->bind(':status', $status);
        $this->execute();

        // Se for pessoa jurídica, inserir dados na tabela locatario_empresa
        if ($tipo == 'Jurídica'):

            // Verificando se existe cadastro da empresa
            $this->query("SELECT * FROM cl_proprietarios_empresa WHERE cl_proprietarios_id = '{$id}'");
            $this->execute();

            if ($this->numRows() == 0):
                // insert
                $query = "INSERT INTO cl_proprietarios_empresa (cl_proprietarios_id, cnpj, inscricao_estadual, razao_social, nome_fantasia, ramo, sede, "
                        . "data_abertura, controle_acionario, capital_aberto, capital_social, contato, email, cep, rua, numero, bairro, zona, cidade)"
                        . "VALUES (:proprietario_id, :cnpj, :inscricao_estadual, :razao_social, :nome_fantasia, :ramo, :sede, :data_abertura, "
                        . ":controle_acionario, :capital_aberto, :capital_social, :contato, :email, :cep, :rua, :numero, :bairro, :zona, :cidade)";
            else:
                // update
                $query = "UPDATE cl_proprietarios_empresa SET cnpj = :cnpj, inscricao_estadual = :inscricao_estadual, "
                        . "razao_social = :razao_social, nome_fantasia = :nome_fantasia, ramo = :ramo, sede = :sede, data_abertura = :data_abertura, "
                        . "controle_acionario = :controle_acionario, capital_aberto = :capital_aberto, capital_social = :capital_social, contato = :contato, "
                        . "email = :email, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, zona = :zona, cidade = :cidade"
                        . " WHERE cl_proprietarios_id = :proprietario_id";
            endif;

            $this->query($query);
            $this->bind(':proprietario_id', $id);
            $this->bind(':cnpj', $empresa_cnpj);
            $this->bind(':inscricao_estadual', $empresa_inscricao_estadual);
            $this->bind(':razao_social', $empresa_razao_social);
            $this->bind(':nome_fantasia', $empresa_nome);
            $this->bind(':ramo', $empresa_ramo);
            $this->bind(':sede', $empresa_sede);
            $this->bind(':data_abertura', $empresa_data_abertura);
            $this->bind(':controle_acionario', $empresa_controle_acionario);
            $this->bind(':capital_aberto', $empresa_capital_aberto);
            $this->bind(':capital_social', $empresa_capital);
            $this->bind(':contato', $empresa_contato);
            $this->bind(':email', $empresa_email);
            $this->bind(':cep', $empresa_cep);
            $this->bind(':rua', $empresa_rua);
            $this->bind(':numero', $empresa_numero);
            $this->bind(':bairro', $empresa_bairro);
            $this->bind(':zona', $empresa_zona);
            $this->bind(':cidade', $empresa_cidade);
            $this->execute();
        else:
            // Se o Tipo não for jurídica, então exclui o que tiver nos dados da empresa antiga
            $query = "DELETE FROM cl_proprietarios_empresa WHERE cl_proprietarios_id = :id";
            $this->query($query);
            $this->bind(':id', $id);
            $this->execute();
        endif;
        
        // Verificando se há imoveis no array
        if (isset($_POST['imovel'])):
            // Inserindo cada imovel no array na tabela de proprietarios do imovel
            foreach ($_POST['imovel'] as $ref):
                $Proprietarios = new Imovel\Proprietarios_DAO();
                $Proprietarios->insert(array($id), $ref);
            endforeach;
        endif;

        // Inserindo no arquivo de log
        $url = URL_ROOT . "clientes/proprietarios/editar?p=" . $id;
        $url = "<a href='{$url}' target='blank'>$id</a>";
        $Log = new Classes\Log();
        $Log->sistema_log("Editou um Proprietário($url)");
    }

    public function delete()
    {
        $id = (int) $_POST['id'];

        // excluindo o proprietario da tabela imovel_proprietarios
        $query = "DELETE FROM imovel_proprietarios WHERE cl_proprietarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id);

        if ($this->execute()):
            // Excluindo o Proprietario
            $query = "DELETE FROM cl_proprietarios WHERE id = :id";
            $this->query($query);
            $this->bind(':id', $id);
            $this->execute();

            // Inserindo log
            $Log = new Classes\Log();
            $Log->sistema_log("Excluiu um Proprietário ({$id})");
        endif;
    }

    public function get($id)
    {
        $query = "SELECT * FROM cl_proprietarios WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->result();
    }

    public function getEmpresa($id)
    {
        $query = "SELECT * FROM cl_proprietarios_empresa WHERE cl_proprietarios_id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();

        if (count($this->result()) == 0):
            $result = array(
                'cnpj' => '',
                'inscricao_estadual' => '',
                'razao_social' => '',
                'nome_fantasia' => '',
                'ramo' => '',
                'sede' => '',
                'data_abertura' => '',
                'controle_acionario' => '',
                'capital_aberto' => '',
                'capital_social' => '',
                'contato' => '',
                'email' => '',
                'cep' => '',
                'rua' => '',
                'numero' => '',
                'bairro' => '',
                'zona' => '',
                'cidade' => ''
            );
        else:
            $result = $this->result();
        endif;

        return $result;
    }
    
    public function getList($limite = null)
    {
//        if ($limite != null):
//            Classes\Paginacao::$total_reg = $limite;
//        endif;
//        $paginacao = Classes\Paginacao::setPaginacao();
//
//        $query = "SELECT * FROM cl_proprietarios";
//        $this->query($query);
//        $this->execute();
//        Classes\Paginacao::totalPaginas($this->numRows());

        if (isset($_GET['orderby'])) {
            $order = _GetString('orderby');
            (isset($_GET['o'])) ? $ordem = _GetString('o') : $ordem = "ASC";
            $query = "SELECT * FROM cl_proprietarios ORDER BY $order $ordem"; // LIMIT $paginacao";
        } else {
            $query = "SELECT * FROM cl_proprietarios ORDER BY id DESC"; // LIMIT $paginacao";
        }

        $this->query($query);
        $this->execute();
        return $this->resultset();
    }

    public function search()
    {
        $busca = $_POST['busca'];

        $query = "SELECT * FROM cl_proprietarios WHERE nome LIKE '%$busca%' OR cpf LIKE '%$busca%' or rg LIKE '%$busca%'";
        $this->query($query);
        $this->execute();
        $result = $this->resultset();
        ?>

        <?php
        if (count($result) == 0):
            echo "<td style='width: 30%;'>Nenhum proprietário encontrado.</td><td></td><td></td><td></td>";
        else:
            foreach ($result as $prop):
                $id = $prop['id'];
                $nome = $prop['nome'];
                $endereco = str_replace(" , ", ", ", $prop['endereco']);
                $contato = $prop['contato'];
                ?>
                <tr id="<?= $id ?>">
                    <td style="width:30%;"><a href="#" ><?= mb_ucwords($nome); ?></a></td>
                    <td style="min-width:50%;"><?= mb_ucwords($endereco); ?></td>
                    <td><?= $contato; ?></td>
                    <td style="border:none; width:10px; background:#FFF;">
                        <?php
                        if (permissao('proprietario_edit')):
                            ?>
                            <a href="<?= URL_ROOT; ?>clientes/proprietarios/editar?p=<?= $id; ?>">
                                <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                            </a>
                            <?php
                        endif;
                        if (permissao('proprietario_del')):
                            ?>
                            <a href="#" onClick="javascript: excluir_proprietario('<?= $id; ?>')" >
                                <img src="<?= DIR_IMG; ?>delete.png" style="margin-right:10px;" />
                            </a>	
                            <?php
                        endif;
                        ?>
                        <br />	
                        <span class="statusExcluir"></span>
                    </td>
                </tr>
                <?php
            endforeach;
        endif;
    }

    public function searchGet()
    {
        $busca = $_POST['busca'];

        $query = "SELECT * FROM cl_proprietarios WHERE nome LIKE '%$busca%' OR rg LIKE '$busca%' OR cpf LIKE '$busca%'";
        $this->query($query);
        $this->execute();
        $result = $this->resultSet();
        ?>
        <div class="table-responsive">
            <table class="table no-margin table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->numRows() == 0):
                        echo "<tr><td>Nenhum Proprietário encontrado. </td><td></td><td></td></tr>";
                    else:
                        foreach ($result as $prop):
                            ?>
                        <tr style="cursor:pointer" data-dismiss="modal" onClick="setWell('proprietario', '<?= $prop['id']; ?>', '<?= $prop['nome'] ?>')">
                            <td><?= $prop['nome']; ?></td>
                            <td><?= $prop['endereco']; ?></td>
                            <td><?= $prop['contato']; ?></td>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }

}
