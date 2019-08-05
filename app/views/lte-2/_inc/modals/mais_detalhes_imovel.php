<?php
// Mais Detalhes
$Detalhes = new App\Models\Imovel\Detalhes_DAO();
$maisDetalhes = $Detalhes->get($id); // id do imovel na pagina detalhes
?>

<div class="modal fade" id="modal-mais-detalhes" tabindex="-1" role="dialog" aria-panelledby="modal-mais-detalhes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-panel="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus-square"></i> Detalhes</h4>
            </div> <!-- ./modal-header -->

            <div class="modal-body">

                <div class="nav-tabs-custom tab-purple">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#detalhes" data-toggle="tab">Detalhes</a></li>
                        <li><a href="#locatarios" data-toggle="tab">Locatários</a></li>
                        <li><a href="#proprietarios" data-toggle="tab">Proprietários</a></li>
                    </ul> <!-- ./nav nav-tabs -->

                    <div class="tab-content">

                        <div class="tab-pane active" id="detalhes">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-unbordered text-light-blue">
                                        <li class="list-group-item"><span class="text-bold text-black">Mat Agespisa:</span> <?= $maisDetalhes['mat_agespisa']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Mat Eletrobras:</span> <?= $maisDetalhes['mat_eletrobras']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">IPTU:</span> <?= $maisDetalhes['iptu']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Valor IPTU:</span> <?= $maisDetalhes['valor_iptu']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Exclusividade:</span> <?= $maisDetalhes['exclusividade']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Ocupação:</span> <?= $maisDetalhes['ocupacao']; ?></li>
                                    </ul>
                                </div>

                                <div class="col-md-6">
                                    <ul class="list-group list-group-unbordered text-light-blue">
                                        <li class="list-group-item"><span class="text-bold text-black">Posição:</span> <?= $maisDetalhes['posicao']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Topografia:</span> <?= $maisDetalhes['topografia']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Área Útil (m²):</span> <?= $maisDetalhes['area_util']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Área Construída (m²):</span> <?= $maisDetalhes['area_construida']; ?></li>
                                        <li class="list-group-item"><span class="text-bold text-black">Área Terreno (m²):</span> <?= $maisDetalhes['area_terreno']; ?></li>
                                    </ul>
                                </div>
                            </div> <!-- ./row -->
                        </div> <!-- ./detalhes -->

                        <div class="tab-pane" id="locatarios">
                            <?php
                            $LocatariosImovel = new App\Models\Imovel\Locatarios_DAO();
                            $locatarios = $LocatariosImovel->getList("WHERE codigo_imovel = '{$codigo}'");
                            
                            foreach ($locatarios as $cli):
                                $id_cli = $cli['cl_locatarios_id'];
                                $result = $Locatarios->get($id_cli);
                                $nome_cli = $result['nome'];
                                ?>
                                <a href="<?= URL_ROOT; ?>clientes/locatarios/editar?l=<?= $id_cli; ?>" target='_blank'>
                                    <div class="well well-sm">
                                        <?= $nome_cli; ?>
                                    </div>
                                </a>
                                <?php
                            endforeach;
                            ?>
                        </div> <!-- ./locatarios -->

                        <div class="tab-pane" id="proprietarios">
                            <?php
                            $ProprietariosImovel = new App\Models\Imovel\Proprietarios_DAO();
                            $proprietarios = $ProprietariosImovel->getList("WHERE codigo_imovel = '{$codigo}'");

                            foreach ($proprietarios as $prop):
                                $id_prop = $prop['cl_proprietarios_id'];
                                $result = $Proprietarios->get($id_prop);
                                $nome_prop = $result['nome'];
                                ?>
                                <a href="<?= URL_ROOT; ?>clientes/proprietarios/editar?p=<?= $id_prop; ?>" target='_blank'>
                                    <div class="well well-sm">
                                        <?= $nome_prop; ?>
                                    </div>
                                </a>
                                <?php
                            endforeach;
                            ?>
                        </div> <!-- ./proprietarios -->

                    </div> <!-- ./tab-content -->

                </div> <!-- ./nav-tabs-custom -->

            </div> <!-- ./modal-body -->

        </div> <!-- ./modal-content -->
    </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->