<?php

use App\Models\Agendamento as Agendamento;

$id = _GetInt('v');

$Visita = new Agendamento\Visitas_DAO();
$result = $Visita->get($id);

$id = $result['id'];
$codigo_imovel = $result['codigo_imovel'];
$dataVisita = dformat($result['dataVisita']);
$horaVisita = $result['hora'];
$cliente = $result['cliente'];
$telefone = $result['telefone'];
$responsavel = $result['responsavel'];
$obs = mb_ucfirst(mb_tolower(stripslashes($result['obs'])));
$status = $result['status'];
?>

<div class="box box-default">
    <div class="box-header with-border">
        <span class="box-title">Editar Visita</span>
    </div>

    <div class="box-body">

        <form id="edit_visita" role="form" action="" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="obrigatorio">Imóvel</label>
                        <input type="text" value="<?= $codigo_imovel; ?>" class="ref form-control" name="imovel" required data-toggle="modal" data-target="#modal-set-imovel" placeholder="Imóvel" />
                    </div>
                    <div class="form-group">
                        <label class="obrigatorio">Data</label>
                        <input type="text" value="<?= $dataVisita; ?>" class="form-control datePicker" name="data" required placeholder="Data" />
                    </div>
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="text" value="<?= $horaVisita; ?>" class="form-control hora" name="hora" placeholder="Hora" />
                    </div>
                    <div class="form-group">
                        <label class="obrigatorio">Cliente</label>
                        <input type="text" value="<?= $cliente; ?>" class="form-control" name="cliente" required placeholder="Cliente" />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" value="<?= $telefone; ?>" class="form-control tel" name="telefone" placeholder="Telefone" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="obrigatorio">Responsável</label>
                        <input type="text" value="<?= $responsavel; ?>" class="form-control" name="responsavel" required placeholder="Responsável" />
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="pendente" <?= ($status == "Pendente") ? "selected" : "" ?>>Pendente</option>
                            <option value="ausente" <?= ($status == "Ausente") ? "selected" : "" ?>>Ausente</option>
                            <option value="remarcar" <?= ($status == "Remarcar") ? "selected" : "" ?>>Remarcar</option>
                            <option value="finalizado" <?= ($status == "Finalizado") ? "selected" : "" ?>>Finalizado</option>
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
                <input type="button" class="btn btn-flat btn-lg bg-red col-xs-2" value="Cancelar" style="margin-left:10px;" onClick="javascript: window.location.href = URL_ROOT + 'agendamento/visitas';" />
                
            </div>
        </form>
    </div>
</div>