<?php

use App\Models\Imovel as Imovel;
use App\Models\Clientes as Clientes;

$Imovel = new Imovel\Imovel_DAO();
$Locatario = new Clientes\Locatarios_DAO();
$result = $Locatario->get(_GetInt('l'));
$empresa = $Locatario->getEmpresa(_GetInt('l'));

$id = $result['id'];
$tipo = $result['tipo'];
$garantia = $result['garantia'];
$endereco = explode(" , ", mb_ucwords($result['endereco']));
$estado_civil = $result['estado_civil'];
$prof_endereco = explode(" , ", mb_ucwords($result['prof_endereco']));

$representante = $result['representante'];
$rep_contato = $result['rep_contato'];
$rep_email = $result['rep_email'];
$rep_display = (empty($representante)) ? 'display: none' : 'display: block';

$status = $result['status'];

$controle_acionario = $empresa['controle_acionario'];
$capital_aberto = $empresa['capital_aberto'];
?>

<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Editar Locatário</span>
    </div>

    <form id="update_locatario" action="" method="post">
        <div class="box-body">

            <div class="nav-tabs-custom tab-purple">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pessoal" data-toggle="tab">Pessoal</a></li>
                    <li><a href="#profissional" data-toggle="tab">Profissional</a></li>
                    <li><a href="#conjuge" data-toggle="tab">Cônjuge</a></li>
                    <li class="empresa" <?= ($tipo != 'Jurídica') ? 'style="display: none"' : ''; ?>><a href="#empresa" data-toggle="tab">Empresa</a></li>
                    <li><a href="#imovel" data-toggle="tab">Imóvel</a></li>
                    <li class="fiador" <?= ($garantia != 'Fiador') ? 'style="display: none"' : ''; ?>><a href="#fiador" data-toggle="tab">Fiador</a></li>
                </ul> <!-- nav -->

                <div class="tab-content" style="padding-top:25px;">

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
                                    <label>Garantia</label>
                                    <select name="garantia" class="form-control">
                                        <option value="fiador" <?= ($garantia == 'Fiador') ? 'selected' : ''; ?> onClick="$('.fiador').show(); $('.valor_caucao').hide()">Fiador</option>
                                        <option value="caução" <?= ($garantia == 'Caução') ? 'selected' : ''; ?> onClick="$('.fiador').hide(); $('.valor_caucao').show()">Caução</option>
                                    </select>
                                </div>
                                <div class="form-group valor_caucao" <?= ($garantia == 'Fiador') ? 'style="display:none;"' : ''; ?>>
                                    <label>Valor da Caução</label>
                                    <input value="<?= nformat($result['valor_caucao']); ?>"  type="text" name="valor_caucao" class="form-control valor text-olive" />
                                </div>

                                <div class="form-group">
                                    <label class="obrigatorio">Nome</label>
                                    <input value="<?= $result['nome']; ?>"  type="text" class="form-control" name="nome" name="nome" required />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input value="<?= $result['rg']; ?>"  type="text" class="form-control" name="rg"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input value="<?= $result['cpf']; ?>"  type="text" class="form-control cpf" name="cpf" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Data nascimento</label>
                                            <input value="<?= $result['data_nasc']; ?>"  type="text" class="form-control data" name="data_nasc" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contato</label>
                                            <input value="<?= $result['contato']; ?>"  type="text" class="form-control tel" name="contato"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input value="<?= $result['email']; ?>"  type="text" class="form-control" name="email" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mãe</label>
                                    <input value="<?= $result['nome_mae']; ?>"  type="text" class="form-control" name="nome_mae" />
                                </div>
                                <div class="form-group">
                                    <label>Pai</label>
                                    <input value="<?= $result['nome_pai']; ?>"  type="text" class="form-control" name="nome_pai" />
                                </div>

                                <div class="form-group">
                                    <label>Declarante</label>
                                    <div class="radio">
                                        <label><input type="radio" name="declarante" value="Sim" <?= ($result['declarante'] == 'Sim') ? 'checked' : '' ?> />Sim</label>
                                        <label></label>
                                        <label><input type="radio" name="declarante" value="Não" <?= ($result['declarante'] != 'Sim') ? 'checked' : '' ?> />Não</label>

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
                                    <input value="<?= $endereco[3]; ?>"  class="form-control cep" type="text" id="cep" name="cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input value="<?= $endereco[0]; ?>"  class="form-control"  type="text" id="rua" name="rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input value="<?= $endereco[1]; ?>"  class="form-control"  type="text" id="numero" name="numero" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control" name="complemento" value="<?= stripslashes($result['complemento']); ?>" />
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input value="<?= $endereco[2]; ?>"  class="form-control"  type="text" id="bairro" name="bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', $endereco[4], 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input value="<?= $endereco[5]; ?>"  class="form-control"  type="text" id="cidade" name="cidade" />
                                </div>
                            </div> <!-- ./right -->
                        </div>
                    </div> <!-- ./pessoal -->

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

                    <div id="profissional" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input value="<?= $result['profissao']; ?>"  type="text" class="form-control" name="profissao" />
                                </div>
                                <div class="form-group">
                                    <label>Firma</label>
                                    <input value="<?= $result['prof_firma']; ?>"  type="text" class="form-control" name="prof_firma" />
                                </div>
                                <div class="form-group">
                                    <label>Função</label>
                                    <input value="<?= $result['prof_funcao']; ?>"  type="text" class="form-control" name="prof_funcao" />
                                </div>
                                <div class="form-group">
                                    <label>Contato</label>
                                    <input value="<?= $result['prof_telefone']; ?>"  type="text" class="form-control tel" name="prof_telefone"/>
                                </div>
                                <div class="form-group">
                                    <label>Salário</label>
                                    <input value="<?= nformat($result['prof_salario']); ?>"  type="text" class="form-control valor text-olive" name="prof_salario" />
                                </div>

                            </div> <!-- left -->

                            <div class="col-md-1"></div> <!-- middle -->

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input value="<?= $prof_endereco[3]; ?>"  class="form-control cep" type="text" id="prof_cep" name="prof_cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input value="<?= $prof_endereco[0]; ?>"  class="form-control"  type="text" id="prof_rua" name="prof_rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input value="<?= $prof_endereco[1]; ?>"  class="form-control"  type="text" id="prof_numero" name="prof_numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input value="<?= $prof_endereco[2]; ?>"  class="form-control"  type="text" id="prof_bairro" name="prof_bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="prof_zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', $prof_endereco[4], 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input value="<?= $prof_endereco[5]; ?>"  class="form-control"  type="text" id="prof_cidade" name="prof_cidade" />
                                </div>
                            </div> <!-- right -->
                        </div>
                    </div> <!-- ./profissional -->

                    <div id="conjuge" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input value="<?= $result['conjuge']; ?>"  type="text" class="form-control" name="conj_nome" />
                                </div>
                                <div class="form-group">
                                    <label>RG</label>
                                    <input value="<?= $result['conj_rg']; ?>"  type="text" class="form-control" name="conj_rg" />
                                </div>
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input value="<?= $result['conj_cpf']; ?>"  type="text" class="form-control cpf" name="conj_cpf" />
                                </div>
                                <div class="form-group">
                                    <label>Data Nascimento</label>
                                    <input value="<?= $result['conj_nasc']; ?>"  type="text" class="form-control data" name="conj_nasc" />
                                </div>
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input value="<?= $result['conj_profissao']; ?>"  type="text" class="form-control" name="conj_prof" />
                                </div>
                                <div class="form-group">
                                    <label>Firma</label>
                                    <input value="<?= $result['conj_firma']; ?>"  type="text" class="form-control" name="conj_firma" />
                                </div>
                                <div class="form-group">
                                    <label>Salário</label>
                                    <input value="<?= nformat($result['conj_salario']); ?>"  type="text" class="form-control valor text-olive" name="conj_salario" />
                                </div>
                            </div> <!-- left -->
                        </div>
                    </div> <!-- ./conjuge -->

                    <div id="imovel" class="tab-pane">
                        <br />
                        <a href="#" data-toggle="modal" data-target="#modal-add-imovel">
                            <img src="<?= DIR_IMG; ?>icon-adicionar.png" />
                        </a>
                        <br /><br />

                        <div id="imovel-content">
                            <?php
                            $Imoveis = new Imovel\Locatarios_DAO();
                            $result = $Imoveis->getList("WHERE cl_locatarios_id = '{$id}'");

                            foreach ($result as $data):
                                $codigo_imovel = $data['codigo_imovel'];

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
                            endforeach;
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <hr />
                        <span class="text-red">
                            <i class="fa fa-exclamation-triangle"></i> Atenção: <br />
                            Ao clicar no botão <i class="fa fa-times text-gray"></i> o imóvel será retirado imediatamente.
                        </span>
                    </div> <!-- ./imovel -->

                    <div id="fiador" class="tab-pane">
                        <br />
                        <a href="#" data-toggle="modal" data-target="#modal-add-fiador">
                            <img src="<?= DIR_IMG; ?>icon-adicionar.png" />
                        </a>
                        <br /><br />

                        <div id="fiador-content">
                            <?php
                            $Fiadores = new App\Models\Clientes\Fiadores_DAO();
                            $result = $Fiadores->getAssoc('locatario', $id);

                            foreach ($result as $fiador):
                                // Id do fiador
                                $id_fiador = $fiador['cl_fiadores_id'];
                                // Buscando dados do Fiador
                                $fiador_dados = $Fiadores->get($id_fiador);
                                $fiador_nome = $fiador_dados['nome'];
                                ?>
                                <div id="fiador-<?= $id_fiador; ?>" class="well well-sm" style="width:40%">
                                    <?= $fiador_nome; ?>
                                    <a href="#" id="fiador-<?= $id_fiador; ?>" class="pull-right text-gray" onClick="removerWell('fiador', '<?= $id_fiador ?>')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <input type="hidden" name="fiador[]" class="form-control" value="<?= $id_fiador; ?>" />
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>

                        <hr />
                        <span class="text-red">
                            <i class="fa fa-exclamation-triangle"></i> Atenção: <br />
                            Ao clicar no botão <i class="fa fa-times text-gray"></i> o fiador será retirado imediatamente.
                        </span>
                    </div> <!-- ./fiador -->

                </div> <!-- ./tab-content -->

            </div> <!-- ./nav-tabs -->

        </div> <!-- ./box-body -->

        <div class="box-footer">
            <input type="hidden" id="page" value="<?= $_GET['action']; ?>" />
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
            <input type="submit" class="btn btn-flat bg-olive btn-lg col-sm-2" value="Salvar" style="margin-right:5px;" />
            <input type="button" class="btn btn-flat bg-red btn-lg col-sm-2" value="Cancelar" onClick="window.location.href = URL_ROOT + 'clientes/locatarios'" />
        </div> <!-- ./box-footer -->
    </form>

</div>