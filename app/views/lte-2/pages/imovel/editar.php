<?php

use App\Models\Imovel as Imovel;
use App\Models as Models;
use Lib\Classes as Classes;

if (!permissao('imovel_edit')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Locatarios = new Models\Clientes\Locatarios_DAO();
$Proprietarios = new Models\Clientes\Proprietarios_DAO();

$LocatariosImovel = new Imovel\Locatarios_DAO();
$ProprietariosImovel = new Imovel\Proprietarios_DAO();
$Imovel = new Imovel\Imovel_DAO();

$imovel = $Imovel->get();

// Dados do Imóvel
$id = $imovel['id'];
$codigo = $imovel['codigo'];
$ref = $imovel['ref'];
$valor = nformat($imovel['valor']);
$endereco = mb_ucwords($imovel['endereco']);
$numero = $imovel['numero'];
$bairro = $imovel['bairro'];
$cidade = $imovel['cidade'];
$zona = $imovel['zona'];
$cep = $imovel['cep'];
$condominio = $imovel['condominio'];
$taxaCond = nformat($imovel['taxaCond']);
$nChave = $imovel['nchave'];
$nApt = $imovel['napt'];
$obs = mb_ucfirst(mb_tolower(stripslashes($imovel['obs'])));
$tipo = $imovel['tipo'];
$categoria = $imovel['categoria'];
$status = $imovel['stats'];
$corretor = $imovel['corretor'];

// Mais Detalhes do Imóvel
$Detalhes = new Imovel\Detalhes_DAO();
$detalhes = $Detalhes->get($id);

$matAgespisa = $detalhes['mat_agespisa'];
$matEletrobras = $detalhes['mat_eletrobras'];
$iptu = $detalhes['iptu'];
$valorIptu = nformat($detalhes['valor_iptu']);
$exclusividade = $detalhes['exclusividade'];
$ocupacao = $detalhes['ocupacao'];
$posicao = $detalhes['posicao'];
$topografia = $detalhes['topografia'];
$areaUtil = $detalhes['area_util'];
$areaConstruida = $detalhes['area_construida'];
$areaTerreno = $detalhes['area_terreno'];
?>

<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Editar Imóvel 
            <span class="text-purple">
                <?= (!empty($ref)) ? $codigo . ' - ' . '<small>#' . $ref . '</small>' : $codigo; ?>
            </span>
        </span>
    </div>

    <form id="update_imovel" action="" method="post">
        <div class="box-body">

            <div class="nav-tabs-custom tab-purple">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#geral" data-toggle="tab">Geral</a></li>
                    <li><a href="#detalhes" data-toggle="tab">Detalhes</a></li>
                    <li><a href="#locatarios" data-toggle="tab">Locatários</a></li>
                    <li><a href="#proprietarios" data-toggle="tab">Proprietários</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="geral">
                        <div class="row" style="margin-top:20px">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="obrigatorio">Código</label>
                                            <input class="form-control" type="text" id="codigo" name="codigo" value=<?= $codigo; ?> required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ref #</label>
                                            <input class="form-control"  type="text" id="ref" name="ref" value="<?= $ref; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Tipo</label>
                                            <select class="form-control" name="tipo">
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_tipo', 'tipo', null, $tipo, 'ORDER BY tipo ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Categoria</label>
                                            <select class="form-control" name="categoria">
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_categoria', 'categoria', null, $categoria, 'ORDER BY categoria ASC', null);
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Situação</label>
                                            <select class="form-control" name="status">
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_stats', 'stats', null, $status, 'ORDER BY stats ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Valor</label>
                                            <input class="form-control text-olive valor" type="text" name="valor" value=<?= $valor; ?> required />
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Corretor</label>
                                    <select class="form-control" name="corretor">
                                        <option value=""></option>
                                        <?php
                                        // @table @option @value @select class="form-control"ed @orderBy @Where
                                        listaOption('config_corretor', 'corretor', null, $corretor, 'ORDER BY corretor ASC', null);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Condomínio/Edifício</label>
                                            <input class="form-control"  type="text" name="condominio" value='<?= $condominio; ?>'/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Taxa Condomínio</label>
                                            <input class="form-control text-olive valor"  type="text" name="taxaCond" value='<?= $taxaCond; ?>'/>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nº Apartamento</label>
                                            <input class="form-control" type="text" name="napt" value='<?= $nApt; ?>'/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nº Chave</label>
                                            <input class="form-control" type="text" name="nchave" value='<?= $nChave; ?>' />
                                        </div>
                                    </div>

                                </div>

                            </div> <!-- ./col-md-4 -->

                            <div class="col-md-1"></div>

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" type="text" id="cep" name="cep" value='<?= $cep; ?>' />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control"  type="text" id="rua" name="rua" value='<?= $endereco; ?>' />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control"  type="text" id="numero" name="numero" value='<?= $numero; ?>' />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control"  type="text" id="bairro" name="bairro" value='<?= $bairro; ?>' />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', $zona, 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input class="form-control"  type="text" id="cidade" name="cidade" value='<?= $cidade; ?>' />
                                </div>
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea class="form-control no-resize" style="height: 100px" name="obs" ><?= $obs; ?></textarea>
                                </div>
                            </div> <!-- ./col-md-4 -->
                        </div>
                    </div> <!-- ./geral -->

                    <div class="tab-pane" id="detalhes">
                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mat. Agespisa</label>
                                    <input class="form-control"  type="text" name="matAgespisa" maxlength="9" value='<?= $matAgespisa; ?>'  />
                                </div>
                                <div class="form-group">
                                    <label>Mat. Eletrobras</label>
                                    <input class="form-control"  type="text" name="matEletrobras" maxlength="8" value='<?= $matEletrobras; ?>' />
                                </div>
                                <div class="form-group">
                                    <label>IPTU</label>
                                    <input class="form-control"  type="text" name="iptu" maxlength="11" value='<?= $iptu; ?>'/>
                                </div>
                                <div class="form-group">
                                    <label>Valor IPTU</label>
                                    <input class="form-control text-olive valor"  type="text" name="valorIptu" value='<?= $valorIptu ?>' />
                                </div>

                                <div class="form-group">
                                    <label>Ocupação</label>
                                    <select class="form-control" name="ocupacao">
                                        <option value="">Selecione</option>
                                        <option value="ocupado" <?= ($ocupacao == "Ocupado") ? "selected" : "" ?>>Ocupado</option>
                                        <option value="Desocupado" <?= ($ocupacao == "Desocupado") ? "selected" : "" ?>>Desocupado</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label>Exclusividade</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="exclusividade" value='SIM' <?= ($exclusividade == "Sim") ? 'checked="true"' : ""; ?> />Sim
                                        </label>
                                        <label></label>
                                        <label>
                                            <input type="radio" name="exclusividade" value='NAO' <?= ($exclusividade == "Nao") ? 'checked="true"' : ""; ?> />Não
                                        </label>
                                    </div>

                                </div>

                            </div> <!-- ./col-md-4 -->

                            <div class="col-md-1"></div>

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>Posição</label>
                                    <select class="form-control" name="posicao">
                                        <option value="">Selecione</option>
                                        <option value="frente" <?= ($posicao == "Frente") ? "selected" : "" ?>>Frente</option>
                                        <option value="fundos" <?= ($posicao == "Fundos") ? "selected" : "" ?>>Fundos</option>
                                        <option value="meio" <?= ($posicao == "Meio") ? "selected" : "" ?>>Meio</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Topografia</label>
                                    <select class="form-control" name="topografia">
                                        <option value="">Selecione</option>
                                        <option value="plano" <?= ($topografia == "Plano") ? "selected" : "" ?>>Plano</option>
                                        <option value="aclive" <?= ($topografia == "Aclive") ? "selected" : "" ?>>Aclive</option>
                                        <option value="declive" <?= ($topografia == "Declive") ? "selected" : "" ?>>Declive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Área Útil (m²)</label>
                                    <input class="form-control"  type="text" name="areaUtil" value='<?= $areaUtil; ?>' />
                                </div>
                                <div class="form-group">
                                    <label>Área Construída (m²)</label>
                                    <input class="form-control"  type="text" name="areaConstruida" value='<?= $areaConstruida; ?>'/>
                                </div>
                                <div class="form-group">
                                    <label>Área Terreno</label>
                                    <input class="form-control"  type="text" name="areaTerreno" value='<?= $areaTerreno; ?>' />
                                </div>
                            </div> <!-- ./col-md-4 -->
                        </div>
                    </div> <!-- ./detalhes -->

                    <div class="tab-pane" id="locatarios">
                        <br />
                        <a href="#" data-toggle="modal" data-target="#modal-add-locatario">
                            <img src="<?= DIR_IMG; ?>icon-adicionar.png" />
                        </a>
                        <br /><br />

                        <div id="locatarios-content">
                            <?php
                            // Buscando todos clientes deste imovel
                            $clientes = $LocatariosImovel->getList("WHERE codigo_imovel = '{$codigo}'");
                            foreach ($clientes as $cliente) {
                                // Pegando o id
                                $id_cliente = $cliente['cl_locatarios_id'];

                                // Buscando o nome do cliente desse id
                                $result = $Locatarios->get($id_cliente);
                                $nome_cliente = $result['nome'];
                                ?>
                                <div id="loca-<?= $id_cliente; ?>" class="well well-sm" style="width:40%">
                                    <?= $nome_cliente; ?>
                                    <a href="#" id="loca-<?= $id_cliente; ?>" class="pull-right text-gray" onClick="removerInput(this, '<?= $codigo; ?>', '<?= $id_cliente; ?>')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <input type="hidden" name="locatarios[]" class="form-control" value="<?= $id_cliente; ?>" />
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <hr />
                        <span class="text-red">
                            <i class="fa fa-exclamation-triangle"></i> Atenção: <br />
                            Ao clicar no botão <i class="fa fa-times text-gray"></i> o locatário será excluido imediatamente.
                        </span>
                    </div> <!-- ./locatarios -->

                    <div class="tab-pane" id="proprietarios">
                        <br />
                        <a href="#" data-toggle="modal" data-target="#modal-add-proprietarios">
                            <img src="<?= DIR_IMG; ?>icon-adicionar.png" />
                        </a>
                        <br /><br />

                        <div id="proprietarios-content">
                            <?php
                            // Buscando todos proprietarios deste imovel
                            $proprietarios = $ProprietariosImovel->getList("WHERE codigo_imovel = '{$codigo}'");

                            foreach ($proprietarios as $proprietario) {
                                // Pegando o id
                                $id_proprietario = $proprietario['cl_proprietarios_id'];

                                // Buscando o nome do proprietario desse ID
                                $result = $Proprietarios->get($id_proprietario);
                                $nome_proprietario = $result['nome'];
                                ?>
                                <div id="prop-<?= $id_proprietario; ?>" class="well well-sm" style="width:40%">
                                    <?= $nome_proprietario; ?>
                                    <a href="#" id="prop-<?= $id_proprietario; ?>" class="pull-right text-gray" onClick="removerInput(this, '<?= $codigo; ?>', '<?= $id_proprietario; ?>')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <input type="hidden" name="proprietarios[]" class="form-control" value="<?= $id_proprietario; ?>" />
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <hr />
                        <span class="text-red">
                            <i class="fa fa-exclamation-triangle"></i> Atenção: <br />
                            Ao clicar no botão <i class="fa fa-times text-gray"></i> o proprietário será excluido imediatamente.
                        </span>
                    </div> <!-- ./proprietarios -->

                </div> <!-- ./tab-content -->

            </div> <!-- ./nav-tabs -->

        </div> <!-- ./box-body -->

        <div class="box-footer">
            <input class="form-control"  type="hidden" id="codigoAtual" name="codigo_atual" value="<?= $codigo; ?>" />
            <input type="submit" class="btn btn-flat bg-olive btn-lg col-sm-2" value="Salvar" style="margin-right:5px;" />
            <input type="button" class="btn btn-flat bg-red btn-lg col-sm-2" value="Cancelar" onClick="window.location.href = '<?= URL_ROOT; ?>imovel/detalhes/<?= $codigo ?>'" />
        </div>
    </form>
</div>