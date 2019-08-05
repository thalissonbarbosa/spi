<?php

use App\Models\Imovel as Imovel;
use App\Models as Models;

$Imovel = new Imovel\Imovel_DAO();
$Home = new Models\Home();
$Avisos = $Home->avisos(1000);
?>

<div class="box box-warning">
    <div class="box-header with-border">
        <span class="box-title"><i class="fa fa-bell"></i> Avisos</span>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <!-- VISITAS -->
                <h4 class="text-orange">Visitas</h4>

                <?php
                if (count($Avisos['visita']) == 0):
                    echo "Nenhuma Visita agendada para os próximos dias.";
                else:
                    ?>
                    <table class="table no-margin table-hover">
                        <thead>
                            <tr>
                                <th>Imóvel</th>
                                <th>Data / Hora</th>
                                <th>Cliente</th>
                                <th>Responsável</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($Avisos['visita'] as $visita):
                                
                                $codigo_imovel_visita = $visita['codigo_imovel'];
                                $hoje = false;
                                $dataVisita = $visita['dataVisita'];
                                if ($dataVisita == date("Y-m-d")) {
                                    $hoje = true;
                                }
                                $date = explode("-", $dataVisita);
                                $dataVisita = $date[2] . "/" . $date[1] . "/" . $date[0];
                                $hora = substr($visita['hora'], 0, 5);

                                $imovel_visita = $Imovel->get($codigo_imovel_visita);
                                $ref_imovel_visita = $imovel_visita['ref'];
                                ?>
                                <tr>
                                    <td><a href=<?= URL_ROOT; ?>imovel/detalhes/<?= $codigo_imovel_visita; ?> >
                                            <span class="white">
                                                <?= (!empty($ref_imovel_visita)) ? '#' . $ref_imovel_visita . ' - ' . $codigo_imovel_visita : $codigo_imovel_visita; ?>
                                            </span>
                                        </a>
                                    </td>
                                    <td><?= $dataVisita . " - " . $hora; ?></td>
                                    <td><?= mb_ucwords($visita['cliente']); ?></td>
                                    <td><?= mb_ucwords($visita['responsavel']); ?></td>
                                    <td>
                                        <a data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= $visita['obs']; ?>">
                                            <img src="<?= DIR_IMG; ?>information.png" style="margin-right:10px;" />
                                        </a>
                                        <?php
                                        if (permissao('imovel_edit')):
                                            ?>
                                            <a href=<?= URL_ROOT; ?>agendamento/visitas/editar?v=<?= $visita['id']; ?>>
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a>
                                            <?php
                                        endif;
                                        if ($hoje):
                                            ?>
                                            <span class="badge bg-orange">Hoje</span>
                                            <?php
                                        endif;
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                <?php
                endif;
                ?>
                <!-- Fim Visita -->
            </div>

            <div class="col-md-6">
                <!-- Serviços -->
                <h4  class="text-orange">Serviços:</h3>

                    <?php
                    if (count($Avisos['servico']) == 0):
                        echo "<p>Nenhum Serviço agendado para os próximos dias.</p>";
                    else:
                        ?>
                        <table class="table no-margin table-hover">
                            <thead>
                                <tr>
                                    <th>Imóvel</th>
                                    <th>Data / Hora</th>
                                    <th>Prestador</th>
                                    <th>Serviço</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($Avisos['servico'] as $servico):
                                    
                                    $codigo_imovel_servico = $servico['codigo_imovel'];
                                    $dataServico = $servico['dataServico'];
                                    $hoje = false;
                                    if ($dataServico == date("Y-m-d")):
                                        $hoje = true;
                                    endif;

                                    $dataServico = dformat($dataServico);
                                    $horaServico = hformat($servico['hora']);
                                    $imovel_servico = $Imovel->get($codigo_imovel_servico);
                                    $ref_imovel_servico = $imovel_servico['ref'];
                                    ?>
                                    <tr>
                                        <td>
                                            <a href=<?= URL_ROOT; ?>imovel/detalhes/<?= $codigo_imovel_servico; ?> >
                                            <?= (!empty($ref_imovel_servico)) ? '#' . $ref_imovel_servico . ' - ' . $codigo_imovel_servico : $codigo_imovel_servico; ?>
                                            </a> 
                                        </td>
                                        <td><?= $dataServico . " - " . $horaServico; ?></td>
                                        <td><?= mb_ucwords($servico['prestador']); ?></td>
                                        <td><?= mb_ucwords($servico['tipoServico']); ?></td>
                                        <td>
                                            <a data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= $servico['obs']; ?>">
                                                <img src="<?= DIR_IMG; ?>information.png" style="margin-right:10px;" />
                                            </a>
                                            <?php
                                            if (permissao('servicos_edit')):
                                                ?>
                                                <a href=<?= URL_ROOT; ?>agendamento/servicos/editar?s=<?= $servico['id']; ?>>
                                                    <img src="<?= DIR_IMG; ?>edit.png" />
                                                </a>
                                                <?php
                                            endif;
                                            if ($hoje):
                                                ?>
                                                <span class="badge bg-orange">Hoje</span>
                                                <?php
                                            endif;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    <?php
                    endif;
                    ?>
                    <!-- Fim Serviços -->
            </div>
        </div>        
    </div>
</div>