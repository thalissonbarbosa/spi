<?php

use Lib\Classes as Classes;
use App\Models\Config as Config;
use App\Models\Imovel as Imovel;

$URL = new Classes\URL();
$Listas = new Classes\Listas();
$Categorias = new Config\Categorias_DAO();
$Imovel = new Imovel\Imovel_DAO();

// PAGINAÇÃO

$result = $Imovel->getList();
$imoveis = $result[0];
$total_linhas = $result[1];
$linhas = count($imoveis);


// total de imóveis / estatisticas
$Imovel->query("SELECT * FROM vw_imoveis WHERE stats != 'DESABILITADO'");
$Imovel->execute();
$total_imoveis = $Imovel->numRows();

$Imovel->query("SELECT * FROM vw_imoveis WHERE tipo = 'ALUGUEL' AND stats != 'DESABILITADO' ");
$Imovel->execute();
$total_imoveis_aluguel = $Imovel->numRows();

$Imovel->query("SELECT * FROM vw_imoveis WHERE tipo = 'VENDA' AND stats != 'DESABILITADO'");
$Imovel->execute();
$total_imoveis_venda = $Imovel->numRows();
?> 		
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Lista de Imóveis</h3>
    </div><!-- /.box-header -->
    <div class="box-body">

        <table id="lista-imoveis" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>#Ref</th>
                    <th class="hidden-xs"></th>
                    <th>Categoria</th>
                    <th>Endereço</th>
                    <th>Valor</th>
                    <th class="hidden-xs">Tipo</th>
                    <th class="hidden-xs">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($imoveis as $imovel):

                    $id = $imovel['id'];
                    $codigo = $imovel['codigo'];
                    $ref = $imovel['ref'];
                    $valor = nformat($imovel['valor']);
                    $endereco = mb_ucwords($imovel['endereco']);
                    $bairro = mb_ucwords($imovel['bairro']);
                    $numero = Classes\CamposDefault::numero($imovel['numero']);

                    $cidade = $imovel['cidade'];
                    $zona = $imovel['zona'];
                    $cep = $imovel['cep'];
                    $tipo = mb_ucwords($imovel['tipo']);
                    $categoria = mb_ucwords($imovel['categoria']);
                    $status = mb_ucwords($imovel['stats']);

                    $img = Classes\CamposDefault::imgPrincipal($imovel['imagemPrincipal'], $codigo, true);

                    $corCategoria = $Categorias->getList("WHERE categoria = '{$categoria}'");
                    $corCategoria = $corCategoria[0]['cor'];
                    ?>
                    <tr onClick="window.open('<?= URL_ROOT . 'imovel/detalhes/' . $codigo; ?>', '_blank')" style="cursor:pointer;">
                        <td><?= $codigo; ?></td>
                        <td><?= $ref; ?></td>
                        <td class="text-center hidden-xs"><img src="<?= DIR_IMG . $img; ?>" width="60%" height="30" /></td>
                        <td style="background:#<?= $corCategoria; ?>; border:none; color:#FFF"><?= $categoria; ?></td>
                        <td><?= $endereco . ", " . $numero . " - " . $bairro . " - Zona " . $zona . ' - ' . $cep; ?></td>
                        <td><span >R$ <?= $valor; ?></span></td>
                        <td class="hidden-xs"><span ><?= $tipo; ?></span></td>
                        <td class="hidden-xs"><span ><?= $status; ?></span></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>

        </table>
        <!-- Estatísticas -->
        <div class="pull-right" style="padding-top:10px;">
            <span class='text-red'>Venda: <span style='color:#000'><?= $total_imoveis_venda ?> </span> | </span>
            <span class='text-red'>Aluguel: <span style='color:#000'><?= $total_imoveis_aluguel; ?> </span> | </span>
            <span class='text-red'>Total de <span style='color:#000'><?= $total_imoveis; ?> </span> imóveis cadastrados</span>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->