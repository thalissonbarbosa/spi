<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Agendar Serviço</span>
    </div>

    <div class="box-body">

        <form id="cad_servicos" role="form" action="" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="obrigatorio">Imóvel</label>
                        <input type="text" name="imovel" class="ref form-control" required data-toggle="modal" data-target="#modal-set-imovel"  placeholder="Imóvel" />
                    </div>
                    <div class="form-group">
                        <label class="obrigatorio">Data</label>
                        <input type="text" class="form-control datePicker" name="dataA" required placeholder="Data" />
                    </div>
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="text" class="form-control hora" name="hora" placeholder="Hora" />
                    </div>
                    <div class="form-group">
                        <label>Prestador</label>
                        <select class="form-control" name="prestador">
                            <?php
                            // @table @option @value @selected @orderBy @where
                            listaOption('config_prestadores', 'nome', null, null, 'ORDER BY id ASC', null);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo de Serviço</label>
                        <select class="form-control" name="tipoServico">
                            <?php
                            // @table @option @value @selected @orderBy @where
                            listaOption('config_tipo_servicos', 'tipo', null, null, 'ORDER BY id ASC', null);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="pendente">Pendente</option>
                            <option value="ausente">Ausente</option>
                            <option value="remarcar">Remarcar</option>
                            <option value="finalizado">Finalizado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Observação</label>
                        <textarea class="form-control no-resize" name="obs" placeholder="Observação"></textarea>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <input type="submit" class="btn bg-olive btn-flat btn-lg col-xs-2" value="Enviar" />
                <input type="button" class="btn btn-flat btn-lg bg-red col-xs-2" value="Cancelar" style="margin-left:10px;" onClick="javascript: window.location.href = URL_ROOT + 'agendamento/servicos';" />
            </div>

        </form>
    </div>
</div>