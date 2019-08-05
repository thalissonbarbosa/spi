<?php

use App\Models\Imovel as Imovel;
use App\Models\Agendamento as Agendamento;
use Lib\Classes as Classes;

$Imovel = new Imovel\Imovel_DAO();
$Visitas = new Agendamento\Visitas_DAO();

if ($_GET['id'] == ''):
    ?>
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Visitas</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="lista" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Cod. Imóvel</th>
                        <th>Ref. Imóvel</th>
                        <th>Cliente</th>
                        <th class="hidden-xs">Telefone</th>
                        <th class="hidden-xs">Responsável</th>
                        <th>Data</th>
                        <th class="hidden-xs">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pegando resultados
                    $result = $Visitas->getList();
                    // Num Rows
                    $linhas = count($result);
                    foreach ($result as $visita) {
                        $imovel = $Imovel->get($visita['codigo_imovel']);
                        $ref_imovel = $imovel['ref'];
                        ?>
                        <tr id="<?= $visita['id']; ?>" style="cursor: default">
                            <td ><a href="<?= URL_ROOT; ?>imovel/detalhes/<?= $visita['codigo_imovel']; ?>" target="_blank" ><?= mb_ucwords($visita['codigo_imovel']); ?></a></td>
                            <td>#<?= $ref_imovel; ?></td>
                            <td><?= mb_ucwords($visita['cliente']); ?></td>

                            <td class="hidden-xs"><?= $visita['telefone']; ?></td>
                            <td class="hidden-xs"><?= mb_ucwords($visita['responsavel']); ?></td>

                            <td><?= dformat($visita['dataVisita']) . " " . $visita['hora']; ?></td>
                            <td class="hidden-xs <?= ($visita['status'] == "Finalizado") ? "text-green" : "text-yellow" ?>"><?= mb_ucwords($visita['status']); ?></td>

                            <td style="width: 110px">

                                <a  class="hidden-xs" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= mb_ucfirst(mb_tolower(stripslashes($visita['obs']))); ?>">
                                    <img src="<?= DIR_IMG; ?>information.png" />
                                </a>

                                <a  class="hidden-xs" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= 'Cadastrado Por: ' . mb_ucwords($visita['usuario']); ?>">
                                    <img src="<?= DIR_IMG; ?>icon-history.png" />
                                </a>
                                <?php if (permissao('visita_edit')):
                                    ?>
                                    <a href="<?= URL_ROOT; ?>agendamento/visitas/editar?v=<?= $visita['id']; ?>" >
                                        <img src="<?= DIR_IMG; ?>edit.png" style="margin-left:20px;" /></a>
                                <?php endif;
                                ?>
                                <?php if (permissao('visita_del')):
                                    ?>
                                    <a href="#" onClick="javascript: excluir_visita('<?= $visita['id']; ?>')" >
                                        <img src="<?= DIR_IMG; ?>delete.png" /></a>
                                <?php endif;
                                ?>	
                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>

            </table>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <?php if (permissao('visita_cad')): ?>
                <a href="<?= URL_ROOT; ?>agendamento/visitas/cadastrar" class="btn bg-olive btn-flat">
                    <i class="fa fa-plus"></i> Agendar Visita
                </a>
                <?php
            endif;
            ?>
        </div>
    </div><!-- /.box -->
    <?php
elseif ($_GET['id'] == 'cadastrar'):

    if (permissao('visita_cad')):
        include ('_cadastrar_visita.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;

elseif ($_GET['id'] == 'editar'):

    if (permissao('visita_edit')):
        include ('_editar_visita.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;
    
endif;
