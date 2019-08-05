<div class="modal fade" id="modal-atendimento" tabindex="-1" role="dialog" aria-labelledby="modal-atendimento">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-phone"></i> Atendimento</h4>
            </div>

            <form id="cad_atendimento" role="form" method="post" action="" >
                <div class="modal-body">
                    <!-- Alertas -->
                    <div id="messages_at"></div>

                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label class="obrigatorio">Nome</label>
                                <input name="at_nome" class="form-control" type="text" placeholder="Nome" required />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="at_email" class="form-control" type="email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label>Telefone/Celular</label>
                                <input name="at_tel" class="form-control tel" type="text" placeholder="Telefone/Celular" />
                            </div>
                            <div class="form-group">
                                <label>Telefone Comercial</label>
                                <input name="at_tel_comercial" class="form-control tel" type="text" placeholder="Telefone Comercial" />
                            </div>
                            <div class="form-group">
                                <label>Como Conheceu</label>
                                <select name="at_conheceu" class="form-control">
                                    <option value="Site">Site</option><option value="Google">Google</option>
                                    <option value="Indicação">Indicação</option><option value="Jornal">Jornal</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Observação</label>
                                <textarea name="at_obs" class="form-control no-resize" rows="3" placeholder="Observação"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="obrigatorio">Interesse</label>
                                <select name="at_interesse" class="form-control">
                                    <option value="Imóvel" selected onClick="$('.imovel-options').show();">Imóvel</option>
                                    <option value="Avaliação" onClick="$('.imovel-options').hide();">Avaliação</option>
                                    <option value="Consultoria" onClick="$('.imovel-options').hide();">Consultoria</option>
                                    <option value="Despachante" onClick="$('.imovel-options').hide();">Despachante</option>
                                </select>
                            </div>
                            
                            <div class="imovel-options">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select name="at_imovel_tipo" class="form-control">
                                        <?php
                                        // @table @option @value @selected @orderBy @where
                                        listaOption('config_tipo', 'tipo', 'value', null, 'ORDER BY tipo ASC', null);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Categoria</label>
                                    <select name="at_imovel_categoria[]" class="form-control" style="height: 100px;" multiple>
                                        <option value="" selected style="display: none"></option>
                                        <?php
                                        // @table @option @value @selected @orderBy @where
                                        listaOption('config_categoria', 'categoria', 'value', null, 'ORDER BY categoria ASC', null);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>De R$</label>
                                    <input type="text" name="at_imovel_valor_de" class="form-control valor text-olive" value="0,00" />
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Até R$</label>
                                    <input type="text" name="at_imovel_valor_ate" class="form-control valor text-olive" placeholder="0,00" />
                                </div>

                                <div class="form-group">
                                    <label>Zona</label>
                                    <select name="at_imovel_zona[]" class="form-control" style="height: 100px;"  multiple>
                                        <option value="Qualquer" selected="selected">Qualquer</option>
                                        <?php
                                        // @table @option @value @selected @orderBy @where
                                        listaOption('config_zonas', 'zona', 'value', null, 'ORDER BY id ASC', null);
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div><!-- ./row -->

                </div> <!-- ./modal-body -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-flat bg-olive" value="Enviar" />
                    <input type="button" class="btn btn-flat bg-red" data-dismiss="modal" value="Cancelar" />
                    <div class="loading"></div>
                </div>
            </form> <!-- ./form -->
        </div> <!-- ./modal-content -->
    </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->