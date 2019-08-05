<?php

use App\Models\Imovel as Imovel;
use App\Models\Agendamento as Agendamento;
use Lib\Classes as Classes;

$Imovel = new Imovel\Imovel_DAO();
$Servicos = new Agendamento\Servicos_DAO();

if ($_GET['id'] == ''):
    ?>

    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Serviços</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="lista" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Cod. Imóvel</th>
                        <th>Ref. Imóvel</th>
                        <th>Prestador</th>
                        <th class="hidden-xs">Tipo de Serviço</th>
                        <th>Data</th>
                        <th class="hidden-xs">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pegando resultados
                    $result = $Servicos->getList();
                    // Num Rows
                    $linhas = count($result);
                    foreach ($result as $servico):
                        $id = $servico['id'];
                        $codigo_imovel = $servico['codigo_imovel'];
                        $imovel = $Imovel->get($codigo_imovel);
                        $ref_imovel = $imovel['ref'];
                        $prestador = $servico['prestador'];
                        $tipoServico = $servico['tipoServico'];
                        $obs = mb_ucfirst(mb_tolower(stripslashes($servico['obs'])));
                        $dataServico = dformat($servico['dataServico']);
                        $hora = $servico['hora'];
                        $status = $servico['status'];
                        ?>
                        <tr id="<?= $id; ?>" style="cursor: default">
                            <td>
                                <a href="<?= URL_ROOT; ?>imovel/detalhes/<?= $codigo_imovel; ?>" target="_blank" >
                                    <?= mb_ucwords($codigo_imovel); ?>
                                </a>
                            </td>
                            <td>#<?= mb_ucwords($ref_imovel) ?></td>
                            <td><?= mb_ucwords($prestador); ?></td>

                            <td class="hidden-xs"><?= mb_ucwords($tipoServico); ?></td>

                            <td><?= $dataServico . " " . $hora; ?></td>
                            <td class="hidden-xs <?= ($status == "Finalizado") ? "text-green" : "text-orange" ?>"><?= mb_ucwords($status); ?></td>

                            <td style="width:110px;">

                                <a class="hidden-xs" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= $obs; ?>">
                                    <img src="<?= DIR_IMG; ?>information.png" style="margin-right:10px;" />
                                </a>
                                <?php if (permissao('servicos_edit')): ?>
                                    <a href="<?= URL_ROOT; ?>agendamento/servicos/editar?s=<?= $id; ?>">
                                        <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                                    </a>
                                <?php endif; ?>
                                <?php if (permissao('servicos_del')): ?>
                                    <a href="#" onClick="javascript: excluir_servicos('<?= $id; ?>')" >
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

        <div class="box-footer">
            <?php if (permissao('servicos_cad')): ?>
                <a href="servicos/cadastrar/" class="btn bg-olive btn-flat">
                    <i class="fa fa-plus"></i> Agendar Serviço
                </a>
                <?php
            endif;
            ?>
        </div>
    </div><!-- /.box -->

    <?php
elseif ($_GET['id'] == 'cadastrar'):

    if (permissao('servicos_cad')):
        include ('_cadastrar_servico.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;


elseif ($_GET['id'] == 'editar'):

    if (permissao('servicos_edit')):
        include ('_editar_servico.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;
    

endif;
