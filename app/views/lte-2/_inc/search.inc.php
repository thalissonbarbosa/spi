<?php

use App\Models\Imovel as Imovel;
use App\Models\Config as Config;
use Lib\Classes as Classes;

$s = $_GET['search'];
$search = new Imovel\Imovel_DAO();
$result = $search->search();
?>

        <?php
        if (count($result) == 0) {
            ?>
            <h3 class="text-center text-muted">Nenhum imóvel encontrado.</h3>
            <?php
        } else {

            $i = 0;
            foreach ($result as $imovel):
                $i = $i + 1;

                $id = $imovel['id'];
                $codigo = $imovel['codigo'];
                $ref = $imovel['ref'];
                $img = Classes\CamposDefault::imgPrincipal($imovel['imagemPrincipal'], $codigo, true);
                $categoria = Classes\CamposDefault::categoria($imovel['categoria']);
                $status = Classes\CamposDefault::status($imovel['stats']);
                $condominio = $imovel['condominio'];

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
                                    <img class="img-responsive img-rounded" src="<?= DIR_IMG . $img; ?>" style="max-width:170px" />
                                </a>

                            </div>
                            
                            <div class="col-md-10">

                                <ul class="list-group" >
                                    <li class="list-group-item no-border"  style="font-size:16px; padding: 0">
                                        
                                        <span class="text-light-blue">
                                            <?=
                                            $imovel['endereco'] . ", " . $imovel['numero'] . " - " . $imovel['bairro'] . " - " . $imovel['zona']
                                            . " - " . $imovel['cep'] . " - " . $imovel['cidade']
                                            . ' - <small class="text-olive">'. $condominio .'</small>';
                                            ?>
                                        </span>

                                    </li>

                                </ul>
                                <span class="no-border-radius label label-lg" style="background:#<?= $corCategoria; ?>; width:150px">
                                    <?= mb_ucwords($categoria); ?>
                                </span>
                                <span class="no-border-radius label label-lg" style="background:#<?= $corStatus; ?>; width:150px">
                                    <?= mb_ucwords($status); ?>
                                </span>
                                <span class="no-border-radius label label-lg" style="background:#<?= $corStatus; ?>; width:150px; margin-top:5px;">
                                    <?= mb_ucwords($imovel['tipo']); ?>
                                </span>

                            </div>
                        </div> <!-- ./row -->
                    </div> <!-- ./box-body -->

                </div> <!-- ./box -->

                <?php
            endforeach;
        }
        ?>
