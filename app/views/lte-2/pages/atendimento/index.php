<?php

use App\Models as Models;

$Atendimento = new Models\Atendimento();

?>

<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Atendimentos</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="lista" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Cliente</th>
                    <th class="hidden-xs">Telefone</th>
                    <th class="hidden-xs">Interesse</th>
                    <th class="hidden-xs">Categoria</th>
                    <th class="hidden-xs">Zona</th>
                    <th>Data</th>
                    <th class="hidden-xs"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Pegando resultados
                $result = $Atendimento->getList();
                // Num Rows
                foreach ($result as $atendimento):

                    $date = date_format(new DateTime($atendimento['data']), 'd/m/Y H:i');
                    $date = explode(" ", $date);
                    $obs = mb_ucfirst(mb_tolower(stripslashes($atendimento['obs'])));
                    ?>
                    <tr id="<?= $atendimento['id']; ?>" class="cursor-pointer" onClick="window.location.href = '<?= URL_ROOT; ?>atendimento/detalhes/<?= $atendimento['id'] ?>'">
                        <td>#<?= str_pad($atendimento['id'], 4, 0, STR_PAD_LEFT) ?></td>
                        <td><?= mb_ucwords($atendimento['nome']); ?></td>
                        <td class="hidden-xs"><?= $atendimento['tel']; ?></td>
                        <td class="hidden-xs"><?= $atendimento['interesse']; ?></td>
                        <td class="hidden-xs"><?= substr($atendimento['imovel_categoria'], 0, strlen($atendimento['imovel_categoria']) - 2); ?></td>
                        <td class="hidden-xs"><?= substr($atendimento['zona'], 0, strlen($atendimento['zona']) - 2); ?></td>
                        <td ><?= $date[0] . " às " . $date[1]; ?></td>
                        <td class="cursor-default hidden-xs" style="width:110px;">

                            <a data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= $obs; ?>">
                                <img src="<?= DIR_IMG; ?>information.png" style="margin-right:10px;" />
                            </a>
                            <?php if (permissao('servicos_edit')): ?>
                                <a href="<?= URL_ROOT; ?>atendimento/editar/<?= $atendimento['id']; ?>">
                                    <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                                </a>
                            <?php endif; ?>
                            <?php if (permissao('servicos_del')): ?>
                                <a href="#" onClick="event.stopPropagation(); excluir_atendimento('<?= $atendimento['id']; ?>', null)" >
                                    <img src="<?= DIR_IMG; ?>delete.png" style="margin-right:10px;" />
                                </a>
                            <?php endif; ?>	
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>

        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
