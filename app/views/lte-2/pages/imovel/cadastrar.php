<?php

use Lib\Classes as Classes;
use App\Models\Imovel as Imovel;

if (!permissao('imovel_cad')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Imovel = new Imovel\Imovel_DAO();
$codigo = $Imovel->getLastCodigo();
?>

<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Cadastrar Imóvel</span>
    </div>

    <form id="insert_imovel" action="" method="post">
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
                                            <input class="form-control" value="<?= $codigo['aluguel']; ?>" type="text" name="codigo" id="codigo" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ref #</label>
                                            <input class="form-control"  type="text" name="ref" id="ref" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Tipo</label>
                                            <select class="form-control" name="tipo">
                                                <?php
                                                $Tipo = new \App\Models\Config\Tipos_DAO();
                                                $result = $Tipo->getList();
                                                foreach ($result as $tipo):
                                                    $nome = mb_ucwords($tipo['tipo']);
                                                    $codigo_on = ($nome == 'Aluguel') ? $codigo['aluguel'] : $codigo['venda'];
                                                    ?>
                                                    <option value="<?= $tipo['id']; ?>" onClick="$('#codigo').attr('value', '<?= $codigo_on ?>');"><?= $nome; ?></option>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Categoria</label>
                                            <select class="form-control" name="categoria">
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_categoria', 'categoria', null, null, 'ORDER BY categoria ASC', null);
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
                                                listaOption('config_stats', 'stats', null, 'disponível', 'ORDER BY stats ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="obrigatorio">Valor</label>
                                            <input class="form-control valor text-olive" type="text" name="valor" value="0,00" required />
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Corretor</label>
                                    <select class="form-control" name="corretor">
                                        <option value=""></option>
                                        <?php
                                        // @table @option @value @select class="form-control"ed @orderBy @Where
                                        listaOption('config_corretor', 'corretor', null, null, 'ORDER BY corretor ASC', null);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Condomínio/Edifício</label>
                                            <input class="form-control"  type="text" name="condominio"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Taxa Condomínio</label>
                                            <input class="form-control text-olive valor"  type="text" name="taxaCond"/>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nº Apartamento</label>
                                            <input class="form-control"  type="text" name="napt" class="numero"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nº Chave</label>
                                            <input class="form-control"  type="text" name="nchave" />
                                        </div>
                                    </div>

                                </div>

                            </div> <!-- ./col-md-4 -->

                            <div class="col-md-1"></div>

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" type="text" id="cep" name="cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control"  type="text" id="rua" name="rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control"  type="text" name="numero" id="numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control"  type="text" name="bairro" id="bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="zona" id="zona">
                                                <option value="">Selecione</option>
                                                <?php
                                                // @table @option @value @select class="form-control"ed @orderBy @Where
                                                listaOption('config_zonas', 'zona', 'value', null, 'ORDER BY id ASC', null);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input class="form-control"  type="text" name="cidade" id="cidade" />
                                </div>
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea name="obs" class="form-control no-resize" style="height: 100px" name="obs" ></textarea>
                                </div>
                            </div> <!-- ./col-md-4 -->
                        </div>
                    </div> <!-- ./geral -->

                    <div class="tab-pane" id="detalhes">
                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mat. Agespisa</label>
                                    <input class="form-control"  type="text" name="matAgespisa" maxlength="9"  />
                                </div>
                                <div class="form-group">
                                    <label>Mat. Eletrobras</label>
                                    <input class="form-control"  type="text" name="matEletrobras" maxlength="8" />
                                </div>
                                <div class="form-group">
                                    <label>IPTU</label>
                                    <input class="form-control"  type="text" name="iptu" maxlength="11" />
                                </div>
                                <div class="form-group">
                                    <label>Valor IPTU</label>
                                    <input class="form-control text-olive valor"  type="text" name="valorIptu" />
                                </div>

                                <div class="form-group">
                                    <label>Ocupação</label>
                                    <select class="form-control" name="ocupacao">
                                        <option value="">Selecione</option>
                                        <option value="ocupado">Ocupado</option>
                                        <option value="Desocupado">Desocupado</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label>Exclusividade</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="exclusividade" value='SIM' />Sim
                                        </label>
                                        <label></label>
                                        <label>
                                            <input type="radio" name="exclusividade" value='NAO' checked="true" />Não
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
                                        <option value="frente">Frente</option>
                                        <option value="fundos">Fundos</option>
                                        <option value="meio">Meio</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Topografia</label>
                                    <select class="form-control" name="topografia">
                                        <option value="">Selecione</option>
                                        <option value="plano">Plano</option>
                                        <option value="aclive">Aclive</option>
                                        <option value="declive">Declive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Área Útil (m²)</label>
                                    <input class="form-control"  type="text" name="areaUtil" />
                                </div>
                                <div class="form-group">
                                    <label>Área Construída (m²)</label>
                                    <input class="form-control"  type="text" name="areaConstruida" />
                                </div>
                                <div class="form-group">
                                    <label>Área Terreno</label>
                                    <input class="form-control"  type="text" name="areaTerreno" />
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

                        </div>

                    </div> <!-- ./locatarios -->

                    <div class="tab-pane" id="proprietarios">

                        <br />
                        <a href="#" data-toggle="modal" data-target="#modal-add-proprietarios">
                            <img src="<?= DIR_IMG; ?>icon-adicionar.png" />
                        </a>
                        <br /><br />

                        <div id="proprietarios-content">

                        </div>

                    </div> <!-- ./proprietarios -->

                </div> <!-- ./tab-content -->

            </div> <!-- ./nav-tabs -->

        </div> <!-- ./box-body -->

        <div class="box-footer">
            <input type="submit" class="btn btn-flat bg-olive btn-lg col-xs-2" value="Salvar" style="margin-right:5px;" />
            <input type="button" class="btn btn-flat bg-red btn-lg col-xs-2" value="Cancelar" onClick="history.back()" />
        </div>
    </form>

</div>