<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Cadastrar Proprietário</span>
    </div>

    <form id="insert_proprietario" action="" method="post">
        <div class="box-body">

            <div class="nav-tabs-custom tab-purple">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pessoal" data-toggle="tab">Pessoal</a></li>
                    <li><a href="#profissional" data-toggle="tab">Profissional</a></li>
                    <li><a href="#conjuge" data-toggle="tab">Cônjuge</a></li>
                    <li class="empresa" style="display: none"><a href="#empresa" data-toggle="tab">Empresa</a></li>
                    <li><a href="#imovel" data-toggle="tab">Imóvel</a></li>
                </ul> <!-- nav -->

                <div class="tab-content" style="margin-top:15px;">

                    <div id="pessoal" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control">
                                                <option selected value="física" onClick="$('.empresa').hide()">Física</option>
                                                <option value="jurídica" onClick="$('.empresa').show()">Jurídica</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="ativo">Ativo</option>
                                                <option value="inativo">Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="obrigatorio">Nome</label>
                                    <input type="text" class="form-control" name="nome" required />
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input type="text" class="form-control" name="rg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CPF</label>
                                            <input type="text" class="form-control cpf" name="cpf" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Contato</label>
                                    <input type="text" class="form-control tel" name="contato"/>
                                </div>

                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" class="form-control" name="email" />
                                </div>

                                <div class="form-group">
                                    <label>Data nascimento</label>
                                    <input type="text" class="form-control data" name="data_nasc" />
                                </div>

                                <div class="form-group">
                                    <label>Estado Civil</label>
                                    <select class="form-control" name="estado_civil">
                                        <option value="" selected>Selecione</option>
                                        <option value="Solteiro">Solteiro(a)</option>
                                        <option value="Casado">Casado(a)</option>
                                        <option value="Separado">Divorciado(a)/Separado(a)</option>
                                        <option value="Viuvo">Viúvo(a)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Declarante</label>
                                    <div class="radio">
                                        <label><input type="radio" name="declarante" value="Sim" />Sim</label>
                                        <label></label>
                                        <label><input type="radio" name="declarante" value="Não" checked />Não</label>

                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Representante</label>
                                    <div class="radio">
                                        <label><input type="radio" name="rep[]" onClick="$('.representante').show();" />Sim</label>
                                        <label></label>
                                        <label><input type="radio" name="rep[]" onClick="$('.representante').hide();" checked />Não</label>

                                    </div>
                                </div>
                                <div class="form-group representante" style="display: none;">
                                    <label>Nome do Representante</label>
                                    <input type="text" class="form-control" name="representante" />
                                </div>

                                <div class="row representante" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contato do Representante</label>
                                            <input type="text" class="form-control tel" name="rep_contato" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email do Representante</label>
                                            <input type="email" class="form-control" name="rep_email" />
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- ./left -->

                            <div class="col-md-1"></div> <!-- ./miffle -->

                            <div class="col-md-4 bg-light-gray">

                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" id="cep" type="text" name="cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control" id="rua" type="text" name="rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control"  type="text" class="numero" name="numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control" name="complemento" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control" id="bairro" type="text" name="bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="zona">
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
                                    <input class="form-control" id="cidade" type="text" name="cidade" />
                                </div>

                            </div> <!-- ./right -->
                        </div>
                    </div> <!-- ./pessoal -->

                    <div id="profissional" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input type="text" class="form-control" name="profissao" />
                                </div>
                                <div class="form-group">
                                    <label>Firma</label>
                                    <input type="text" class="form-control" name="prof_firma" />
                                </div>
                                <div class="form-group">
                                    <label>Função</label>
                                    <input type="text" class="form-control" name="prof_funcao" />
                                </div>
                                <div class="form-group">
                                    <label>Contato</label>
                                    <input type="text" class="form-control tel" name="prof_telefone"/>
                                </div>
                            </div> <!-- left -->

                            <div class="col-md-1"></div> <!-- middle -->

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" id="prof_cep" type="text" name="prof_cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control" id="prof_rua" type="text" name="prof_rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control"  type="text" name="prof_numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control" id="prof_bairro" type="text" name="prof_bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="prof_zona">
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
                                    <input class="form-control" id="prof_cidade" type="text" name="prof_cidade" />
                                </div>
                            </div> <!-- right -->
                        </div>
                    </div> <!-- ./profissional -->

                    <div id="conjuge" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="conj_nome" />
                                </div>
                                <div class="form-group">
                                    <label>RG</label>
                                    <input type="text" class="form-control" name="conj_rg" />
                                </div>
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="text" class="form-control cpf" name="conj_cpf" />
                                </div>
                                <div class="form-group">
                                    <label>Data Nascimento</label>
                                    <input type="text" class="form-control data" name="conj_nasc" />
                                </div>
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input type="text" class="form-control" name="conj_prof" />
                                </div>
                            </div> <!-- left -->
                        </div>
                    </div> <!-- ./conjuge -->

                    <div id="empresa" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CNPJ</label>
                                    <input type="text" name="empresa_cnpj" class="form-control cnpj" />
                                </div>
                                <div class="form-group">
                                    <label>Inscrição Estadual</label>
                                    <input type="text" name="empresa_inscricao_estadual" class="form-control" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Razão Social</label>
                                            <input type="text" name="empresa_razao_social" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome Fantasia</label>
                                            <input type="text" name="empresa_nome_fantasia" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ramo de Atividade</label>
                                            <input type="text" name="empresa_ramo" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sede</label>
                                            <input type="text" name="empresa_sede" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Data de Abertura da Empresa</label>
                                            <input type="text" name="empresa_data_abertura" class="form-control data" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Controle Acionário</label>
                                            <select name="empresa_controle_acionario" class="form-control">
                                                <option value="">Selecione</option>
                                                <option value="nacional">Nacional</option>
                                                <option value="estrangeiro">Estrangeiro</option>
                                                <option value="estatal">Estatal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capital Aberto</label>
                                            <select name="empresa_capital_aberto" class="form-control">
                                                <option value="sim">Sim</option>
                                                <option value="não">Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capital Social</label>
                                            <input type="text" name="empresa_capital_social" class="form-control valor text-olive" />
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Contato</label>
                                    <input type="tel" class="form-control tel" name="empresa_contato" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="empresa_email" />
                                </div>
                            </div>

                            <div class="col-md-1"></div>

                            <div class="col-md-4 bg-light-gray">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <input class="form-control cep" type="text" id="empresa_cep" name="empresa_cep" />
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Rua</label>
                                            <input class="form-control" type="text" id="empresa_rua" name="empresa_rua" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nº</label>
                                            <input class="form-control" type="text" id="empresa_numero" name="empresa_numero" />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Bairro</label>
                                            <input class="form-control" type="text" id="empresa_bairro" name="empresa_bairro" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Zona</label>
                                            <select class="form-control" name="empresa_zona">
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
                                    <input class="form-control"  type="text" id="empresa_cidade" name="empresa_cidade" />
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

                        </div>
                    </div> <!-- ./imovel -->

                </div> <!-- ./tab-content -->

            </div> <!-- ./nav-tabs -->

        </div> <!-- ./box-body -->

        <div class="box-footer">
            <input type="hidden" id="page" value="<?= $_GET['action']; ?>" />
            <input type="submit" class="btn btn-flat bg-olive btn-lg col-sm-2" value="Cadastrar" style="margin-right:5px;" />
            <input type="button" class="btn btn-flat bg-red btn-lg col-sm-2" value="Cancelar" onClick="window.location.href = URL_ROOT + 'clientes/proprietarios'" />
        </div>
    </form>

</div>