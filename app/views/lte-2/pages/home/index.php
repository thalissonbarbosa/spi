<?php

use Lib\Classes as Classes;
use App\Models\Config as Config;
use App\Models as Models;
use App\Models\Clientes as Clientes;
use App\Models\Imovel as Imovel;

$Home = new Models\Home();
$Alertas = new \Lib\Classes\Messages();

// Estatísticas
$Imovel = new Imovel\Imovel_DAO();
$total_imoveis = $Imovel->getList();

$Atendimentos = new Models\Atendimento();
$total_atendimentos = count($Atendimentos->getList(500));

$Locatarios = new Clientes\Locatarios_DAO();
$Fiadores = new Clientes\Fiadores_DAO();
$Proprietarios = new Clientes\Proprietarios_DAO();
$total_clientes = count($Locatarios->getList(null, 500)) + count($Fiadores->getList(null, 500)) + count($Proprietarios->getList(500));

$Visitas = new Models\Agendamento\Visitas_DAO();
$total_visitas = count($Visitas->getList());

$Avisos = $Home->avisos(5);
?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $total_imoveis[1] ?></h3>

                <p>Imóveis</p>
            </div>
            <div class="icon">
                <i class="fa fa-home"></i>
            </div>
            <a href="<?= URL_ROOT; ?>imovel/lista" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3><?= $total_atendimentos; ?></h3>

                <p>Atendimentos</p>
            </div>
            <div class="icon">
                <i class="fa fa-phone"></i>
            </div>
            <a href="<?= URL_ROOT; ?>atendimento" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
                <h3><?= $total_clientes; ?></h3>

                <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?= URL_ROOT; ?>clientes" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $total_visitas; ?></h3>

                <p>Visitas</p>
            </div>
            <div class="icon" style="margin-top:-5px">
                <i class="fa fa-calendar" style="font-size:85%;"></i>
            </div>
            <a href="<?= URL_ROOT; ?>agendamento/visitas" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<br /><br />

<div class="row">
    <div class="col-md-7">

        <?php
        $recentes = $Home->imoveisRecentes(4);
        foreach ($recentes as $imovel):

            $codigo = $imovel['codigo'];
            $ref = $imovel['ref'];
            $img = Classes\CamposDefault::imgPrincipal($imovel['imagemPrincipal'], $codigo, true);
            $categoria = Classes\CamposDefault::categoria($imovel['categoria']);
            $status = Classes\CamposDefault::status($imovel['stats']);

            $valor = nformat($imovel['valor']);

            $Categorias = new Config\Categorias_DAO();
            $cor = $Categorias->getList("WHERE categoria = '{$imovel['categoria']}'");
            $corCategoria = $cor[0]['cor'];

            $Status = new Config\Status_DAO();
            $cor = $Status->getList("WHERE stats = '{$imovel['stats']}'");
            $corStatus = $cor[0]['cor'];
            ?>
            <div class="box box-default">

                <div class="box-header with-border">
                    <span class="box-title">
                        <?= (!empty($ref)) ?  $codigo . ' - ' . '<small>#' . $ref . '</small>' : $codigo; ?>
                    </span>
                    <span class="box-title text-olive pull-right">
                        R$ <?= $valor; ?>
                    </span>

                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">

                            <a  href=<?= URL_ROOT . "imovel/detalhes/" . $codigo; ?>>
                                <img class="img-responsive" src="<?= DIR_IMG . $img; ?>" style="min-width:170px" />
                            </a>

                        </div>
                        <div class="col-md-1"></div>

                        <div class="col-md-9">
                            <ul class="list-group">
                                <li class="list-group-item no-border no-padding"  style="font-size:16px;">
                                    <span class="text-light-blue">
                                        <?=
                                        $imovel['endereco'] . ", " . $imovel['numero'] . " - " . $imovel['bairro'] . " - " . $imovel['zona']
                                        . " - " . $imovel['cep'] . " - " . $imovel['cidade'];
                                        ?>
                                    </span>
                                </li>
                                <li class="list-group-item no-border"></li>
                                
                                <li class="list-group-item no-border no-padding">
                                    <div class="no-border-radius label label-lg" style="width:150%; background:#<?= $corCategoria; ?>;">
                                        <?= mb_ucwords($categoria); ?>
                                    </div>
                                    <span class="no-border-radius label label-lg" style="width:150px;background:#<?= $corStatus; ?>;">
                                        <?= mb_ucwords($status); ?>
                                    </span>
                                    <span class="no-border-radius label label-lg bg-light-blue" style="width:150px;">
                                        <?= mb_ucwords($imovel['tipo']); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>

                    </div> <!-- ./row -->
                </div> <!-- ./box-body -->

            </div> <!-- ./box -->

            <?php
        endforeach;
        ?>

    </div> <!-- ./col-md-8 -->

    <div class="col-md-5">

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Visitas
                </h3>
            </div>
            <div class="box-body">

                <?php
                if (count($Avisos['visita']) == 0):
                    echo "Nenhuma Visita agendada para os próximos dias.";
                else:
                    ?>
                    <div class="table-responsive">
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
                                    $dataVisita = $visita['dataVisita'];
                                    $hoje = false;
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
                                        <td>
                                            <a href=<?= URL_ROOT; ?>imovel/detalhes/<?= $codigo_imovel_visita; ?> >
                                                <span class="white">
                                                    <?= (!empty($ref_imovel_visita)) ? '#' . $ref_imovel_visita . ' - ' . $codigo_imovel_visita : $codigo_imovel_visita; ?>
                                                </span>
                                            </a>
                                        </td>
                                        <td><?= $dataVisita . " - " . $hora; ?></td>
                                        <td><?= mb_ucwords($visita['cliente']); ?></td>
                                        <td><?= mb_ucwords($visita['responsavel']); ?></td>
                                        <td>
                                            <a data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= mb_ucfirst(mb_tolower($visita['obs'])); ?>">
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
                    </div><!-- ./table-responsive -->
                <?php
                endif;
                ?>
                <!-- ./Visita -->

            </div> <!-- ./box-body -->
        </div> <!-- ./box visitas --> 

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Serviços
                </h3>
            </div>

            <div class="box-body">

                <?php
                if (count($Avisos['servico']) == 0):
                    echo "<p>Nenhum Serviço agendado para os próximos dias.</p>";
                else:
                    ?>
                    <div class="table-responsive">
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
                                            <a data-toggle="popover" data-placement="left" data-trigger="hover" data-content="<?= mb_ucfirst(mb_tolower($servico['obs'])); ?>">
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
                    </div> <!-- ./div table responsive -->
                <?php
                endif;
                ?>
            </div> <!-- ./box-body -->
        </div> <!-- ./box serviços -->

    </div> <!-- ./col-md-4 -->

</div> <!-- ./row -->

