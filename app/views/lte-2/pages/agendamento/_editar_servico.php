<?php
use App\Models\Agendamento as Agendamento;
$id = _GetInt('s');

$Servico = new Agendamento\Servicos_DAO();
$result = $Servico->get($id);

$codigo_imovel = $result['codigo_imovel'];
$dataServico = dformat($result['dataServico']);
$horaServico = $result['hora'];
$status = $result['status'];
$obs = mb_ucfirst(mb_tolower(stripslashes($result['obs'])));
$prestador = $result['config_prestadores_id'];
$servico = $result['config_tipo_servicos_id'];
?>

<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Agendar Serviço</span>
    </div>

    <div class="box-body">

        <form id="edit_servicos" role="form" action="" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Imóvel</label>
                        <input type="text" value="<?= $codigo_imovel; ?>" class="ref form-control" name="imovel" required data-toggle="modal" data-target="#modal-set-imovel" placeholder="Imóvel" />
                    </div>
                    <div class="form-group">
                        <label>Data</label>
                        <input type="text" value="<?= $dataServico; ?>" class="form-control datePicker" name="data" required placeholder="Data" />
                    </div>
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="text" value="<?= $horaServico; ?>" class="form-control hora" name="hora" placeholder="Hora" />
                    </div>
                    <div class="form-group">
                        <label>Prestador</label>
                        <select class="form-control" name="prestador">
                            <?php
                            // @table @option @value @selected @orderBy @where
                            listaOption('config_prestadores', 'nome', null, $prestador, 'ORDER BY id ASC', null);
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
                            listaOption('config_tipo_servicos', 'tipo', null, $servico, 'ORDER BY id ASC', null);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="pendente" <?= ($status == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                            <option value="ausente" <?= ($status == 'Ausente') ? 'selected' : ''; ?>>Ausente</option>
                            <option value="remarcar" <?= ($status == 'Remarcar') ? 'selected' : ''; ?>>Remarcar</option>
                            <option value="finalizado" <?= ($status == 'Finalizado') ? 'selected' : ''; ?>>Finalizado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Observação</label>
                        <textarea class="form-control no-resize" name="obs" placeholder="Observação"><?= $obs; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <input type="hidden" name="id" value="<?= $id; ?>" />
                <input type="submit" class="btn bg-olive btn-flat btn-lg col-xs-2" value="Salvar" />
                <input type="button" class="btn btn-flat btn-lg bg-red col-xs-2" value="Cancelar" style="margin-left:10px;" onClick="javascript: window.location.href = URL_ROOT + 'agendamento/servicos';" />
            </div>

        </form>
    </div>
</div>