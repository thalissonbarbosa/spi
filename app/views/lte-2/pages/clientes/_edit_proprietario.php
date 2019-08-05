<?php

use App\Models\Clientes as Clientes;
use App\Models\Imovel as Imovel;

$Imovel = new Imovel\Imovel_DAO();
$Proprietario = new Clientes\Proprietarios_DAO();
$result = $Proprietario->get(_GetInt('p'));
$empresa = $Proprietario->getEmpresa(_GetInt('p'));

$id = $result['id'];
$tipo = $result['tipo'];
$nome = $result['nome'];
$cpf = $result['cpf'];
$rg = $result['rg'];
$endereco = explode(" , ", mb_ucwords($result['endereco']));
$complemento = $result['complemento'];
$zona = $endereco[4];
$data_nasc = $result['data_nasc'];
$estado_civil = $result['estado_civil'];
$contato = $result['contato'];
$email = $result['email'];
$declarante = $result['declarante'];
$representante = $result['representante'];
$rep_contato = $result['rep_contato'];
$rep_email = $result['rep_email'];
$rep_display = (empty($representante)) ? 'display: none' : 'display: block';

$status = $result['status'];

$profissao = $result['profissao'];
$prof_firma = $result['prof_firma'];
$prof_endereco = explode(" , ", mb_ucwords($result['prof_endereco']));
$prof_zona = $prof_endereco[4];
$prof_funcao = $result['prof_funcao'];
$prof_telefone = $result['prof_telefone'];

$conjuge = $result['conjuge'];
$conj_nasc = $result['conj_nasc'];
$conj_rg = $result['conj_rg'];
$conj_cpf = $result['conj_cpf'];
$conj_profissao = $result['conj_profissao'];

$controle_acionario = $empresa['controle_acionario'];
$capital_aberto = $empresa['capital_aberto'];
$capital_social = $empresa['capital_social'];
?>

<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Editar Proprietário</span>
    </div>

    <form id="update_proprietario" action="" method="post">
        <div class="box-body">

            <div class="nav-tabs-custom tab-purple">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pessoal" data-toggle="tab">Pessoal</a></li>
                    <li><a href="#profissional" data-toggle="tab">Profissional</a></li>
                    <li><a href="#conjuge" data-toggle="tab">Cônjuge</a></li>
                    <li class="empresa" <?= ($tipo != 'Jurídica') ? 'style="display: none"' : ''; ?>><a href="#empresa" data-toggle="tab">Empresa</a></li>
                    <li><a href="#imovel" data-toggle="tab">Imóvel</a></li>
                </ul> <!-- nav -->

                <div class="tab-content">

                    <div id="pessoal" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control">
                                                <option value="física" <?= ($tipo == 'Física') ? 'selected' : ''; ?> onClick="$('.empresa').hide()">Física</option>
                                                <option value="jurídica" <?= ($tipo == 'Jurídica') ? 'selected' : ''; ?> onClick="$('.empresa').show()">Jurídica</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="ativo" <?= ($status == 'Ativo') ? 'selected="selected"' : ''; ?>>Ativo</option>
                                                <option value="inativo" <?= ($status == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Nome</label>
                                    <input type="text" value="<?= $nome ?>" class="form-control" name="nome" required />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input type="text" value="<?= $rg ?>" class="form-control" name="rg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input type="text" value="<?= $cpf ?>" class="form-control cpf" name="cpf" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Contato</label>
                                    <input type="text" value="<?= $contato ?>" class="form-control tel" name="contato"/>
                                </div>

                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" value="<?= $email ?>" class="form-control" name="email" />
                                </div>

                                <div class="form-group">
                                    <label>Data nascimento</label>
                                    <input type="text" value="<?= $data_nasc ?>" class="form-control data" name="data_nasc" />
                                </div>

                                <div class="form-group">
                                    <label>Estado Civil</label>
                                    <select class="form-control" name="estado_civil">
                                        <option value="" selected>Selecione</option>
                                        <option value="Solteiro" <?= ($estado_civil == 'Solteiro') ? 'selected' : '' ?>>Solteiro(a)</option>
                                        <option value="Casado" <?= ($estado_civil == 'Casado') ? 'selected' : '' ?>>Casado(a)</option>
                                        <option value="Separado" <?= ($estado_civil == 'Separado') ? 'selected' : '' ?>>Divorciado(a)/Separado(a)</option>
                                        <option value="Viuvo" <?= ($estado_civil == 'Viuvo') ? 'selected' : '' ?>>Viúvo(a)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Declarante</label>
                                    <div class="radio">
                                        <label><input type="radio" name="declarante" value="Sim" <?= ($declarante == 'Sim') ? 'checked' : '' ?> />Sim</label>
                                        <label></label>
                                        <label><input type="radio" name="declarante" value="Não" <?= ($declarante != 'Sim') ? 'checked' : '' ?> />Não</label>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Representante</label>
                                    <div class="radio">
                                        <label><input type="radio" name="rep[]" <?= (!empty($representante)) ? 'checked' : '' ?> onClick="$('.representante').show();" />Sim</label>
                                        <label></label>
                                        <label><input type="radio" name="rep[]" <?= (empty($representante)) ? 'checked' : '' ?> onClick="$('.representante').hide(); $('.rep-value').attr('value', '')" />Não</label>

                                    </div>
                                </div>
                                <div class="form-group representante" style="<?= $rep_display; ?>">
                                    <label>Nome do Representante</label>
                                    <input type="text" value="<?= $representante; ?>" class="form-control rep-value" name="representante" />
                                </div>

                                <div class="row representante" style="<?= $rep_display; ?>">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contato do Representante</label>
                                            <input type="text" value="<?= $rep_contato; ?>" class="form-control tel rep-value" name="rep_contato" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email do Representante</label>
                                            <input type="email" value="<?= $rep_email; ?>" class="form-control rep-value" name="rep_email" />
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- ./left -->

                            <div class="col-md-1"></div> <!-- ./miffle -->

                            <div class="col-md-4 bg-light-gray">

                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" value="<?= $endereco['3'] ?>" type="text" name="cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control" value="<?= $endereco['0'] ?>"  type="text" name="rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control" value="<?= $endereco['1'] ?>" type="text" class="numero" name="numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control" name="complemento" value="<?= stripslashes($complemento); ?>" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control" value="<?= $endereco['2'] ?>"  type="text" name="bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', $endereco['4'], 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input class="form-control" value="<?= $endereco['5'] ?>" type="text" name="cidade" />
                                </div>

                            </div> <!-- ./right -->
                        </div>
                    </div> <!-- ./pessoal -->

                    <div id="profissional" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input type="text" value="<?= $profissao ?>" class="form-control" name="profissao" />
                                </div>
                                <div class="form-group">
                                    <label>Firma</label>
                                    <input type="text" value="<?= $prof_firma ?>" class="form-control" name="prof_firma" />
                                </div>
                                <div class="form-group">
                                    <label>Função</label>
                                    <input type="text" value="<?= $prof_funcao ?>" class="form-control" name="prof_funcao" />
                                </div>
                                <div class="form-group">
                                    <label>Contato</label>
                                    <input type="text" value="<?= $prof_telefone ?>" class="form-control tel" name="prof_telefone"/>
                                </div>
                            </div> <!-- left -->

                            <div class="col-md-1"></div> <!-- middle -->

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" value="<?= $prof_endereco['3'] ?>" type="text" id="prof_cep" name="prof_cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control" value="<?= $prof_endereco['0'] ?>"  type="text" id="prof_rua" name="prof_rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control" value="<?= $prof_endereco['1'] ?>" type="text" id="prof_numero" name="prof_numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control" value="<?= $prof_endereco['2'] ?>" type="text" id="prof_bairro" name="prof_bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="prof_zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', $prof_endereco['4'], 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input class="form-control" value="<?= $prof_endereco['5'] ?>" type="text" id="prof_cidade" name="prof_cidade" />
                                </div>
                            </div> <!-- right -->
                        </div>
                    </div> <!-- ./profissional -->

                    <div id="conjuge" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" value="<?= $conjuge ?>" class="form-control" name="conj_nome" />
                                </div>
                                <div class="form-group">
                                    <label>RG</label>
                                    <input type="text" value="<?= $conj_rg ?>" class="form-control" name="conj_rg" />
                                </div>
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="text" value="<?= $conj_cpf ?>" class="form-control cpf" name="conj_cpf" />
                                </div>
                                <div class="form-group">
                                    <label>Data Nascimento</label>
                                    <input type="text" value="<?= $conj_nasc ?>" class="form-control data" name="conj_nasc" />
                                </div>
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input type="text" value="<?= $conj_profissao ?>" class="form-control" name="conj_prof" />
                                </div>
                            </div> <!-- left -->
                        </div>
                    </div> <!-- ./conjuge -->

                    <div id="empresa" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CNPJ</label>
                                    <input value="<?= $empresa['cnpj']; ?>"  type="text" name="empresa_cnpj" class="form-control cnpj" />
                                </div>
                                <div class="form-group">
                                    <label>Inscrição Estadual</label>
                                    <input value="<?= $empresa['inscricao_estadual']; ?>"  type="text" name="empresa_inscricao_estadual" class="form-control" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Razão Social</label>
                                            <input value="<?= $empresa['razao_social']; ?>"  type="text" name="empresa_razao_social" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome Fantasia</label>
                                            <input value="<?= $empresa['nome_fantasia']; ?>"  type="text" name="empresa_nome_fantasia" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ramo de Atividade</label>
                                            <input value="<?= $empresa['ramo']; ?>"  type="text" name="empresa_ramo" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sede</label>
                                            <input value="<?= $empresa['sede']; ?>"  type="text" name="empresa_sede" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Data de Abertura da Empresa</label>
                                            <input value="<?= $empresa['data_abertura']; ?>"  type="text" name="empresa_data_abertura" class="form-control data" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Controle Acionário</label>
                                            <select name="empresa_controle_acionario" class="form-control">
                                                <option value="">Selecione</option>
                                                <option value="nacional" <?= ($controle_acionario == 'Nacional') ? 'selected' : ''; ?>>Nacional</option>
                                                <option value="estrangeiro" <?= ($controle_acionario == 'Estrangeiro') ? 'selected' : ''; ?>>Estrangeiro</option>
                                                <option value="estatal" <?= ($controle_acionario == 'Estatal') ? 'selected' : ''; ?>>Estatal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capital Aberto</label>
                                            <select name="empresa_capital_aberto" class="form-control">
                                                <option value="sim" <?= ($capital_aberto == 'Sim') ? 'selected' : ''; ?>>Sim</option>
                                                <option value="não" <?= ($capital_aberto == 'Não') ? 'selected' : ''; ?>>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capital Social</label>
                                            <input value="<?= nformat($empresa['capital_social']); ?>"  type="text" name="empresa_capital_social" class="form-control valor text-olive" />
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Contato</label>
                                    <input value="<?= $empresa['contato']; ?>"  type="tel" class="form-control tel" name="empresa_contato" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input value="<?= $empresa['email']; ?>"  type="email" class="form-control" name="empresa_email" />
                                </div>
                            </div>

                            <div class="col-md-1"></div>

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input value="<?= $empresa['cep']; ?>"  class="form-control cep" type="text" id="empresa_cep" name="empresa_cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input value="<?= $empresa['rua']; ?>"  class="form-control" type="text" id="empresa_rua" name="empresa_rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input value="<?= $empresa['numero']; ?>"  class="form-control" type="text" id="empresa_numero" name="empresa_numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input value="<?= $empresa['bairro']; ?>"  class="form-control" type="text" id="empresa_bairro" name="empresa_bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="empresa_zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', $empresa['zona'], 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input value="<?= $empresa['cidade']; ?>"  class="form-control"  type="text" id="empresa_cidade" name="empresa_cidade" />
                                </div>
                            </div>
                        </div>


                    </div><!-- ./ empresa -->

                    <div id="imovel" class="tab-pane">
                        <br />
                        <a href="#" data-toggle="modal" data-target="#modal-add-imovel">
                            <img src="<?= DIR_IMG; ?>icon-adicionar.png" />
                        </a>
                        <br /><br />

                        <div id="imovel-content">
                            <?php
                            $ProprietariosImovel = new App\Models\Imovel\Proprietarios_DAO();
                            $imoveis = $ProprietariosImovel->getList("WHERE cl_proprietarios_id = '{$id}'");
                            foreach ($imoveis as $cliente) {
                                // Pegando o id
                                $id_cliente = $cliente['cl_proprietarios_id'];
                                $codigo_imovel = $cliente['codigo_imovel'];

                                // Buscando o imovel
                                $imovel = $Imovel->get($codigo_imovel);
                                ?>
                                <div id="imovel-<?= $codigo_imovel; ?>" class="well well-sm pull-left" style="width:20%; margin-right: 15px;">
                                    <a href="<?= URL_ROOT; ?>imovel/detalhes/<?= $codigo_imovel; ?>" target="_blank"><strong><?= $codigo_imovel; ?></strong></a> 
                                    - <span class="text-olive"><?= $imovel['condominio'] ?></span>
                                    - Nº <?= $imovel['napt'] ?>
                                    
                                    <a href="#" id="imovel<?= $codigo_imovel; ?>" class="pull-right text-gray" onClick="removerImovel('<?= $codigo_imovel; ?>')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <br />
                                    <?=
                                    $imovel['endereco'] . ", " . $imovel['numero'] . " - " . $imovel['bairro'] . " , " . $imovel['cep']
                                    . " - Zona " . $imovel['zona'] . " - " . $imovel['cidade'];
                                    ?>

                                    
                                    <input type="hidden" name="imovel[]" class="form-control" value="<?= $codigo_imovel; ?>" />
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <hr />
                        <span class="text-red">
                            <i class="fa fa-exclamation-triangle"></i> Atenção: <br />
                            Ao clicar no botão <kbd><i class="fa fa-times"></i></kbd> o imóvel será retirado imediatamente.
                        </span>
                    </div> <!-- ./imovel -->

                </div> <!-- ./tab-content -->

            </div> <!-- ./nav-tabs -->

        </div> <!-- ./box-body -->

        <div class="box-footer">
            <input type="hidden" id="page" value="<?= $_GET['action']; ?>" />
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
            <input type="submit" class="btn btn-flat bg-olive btn-lg col-sm-2" value="Salvar" style="margin-right:5px;" />
            <input type="button" class="btn btn-flat bg-red btn-lg col-sm-2" value="Cancelar" onClick="window.location.href = URL_ROOT + 'clientes/proprietarios'" />
        </div>
    </form>

</div>