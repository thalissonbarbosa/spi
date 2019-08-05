
<?php

use App\Models\Imovel as Imovel;
use App\Models\Config as Config;
use Lib\Classes as Classes;

$Imovel = new Imovel\Imovel_DAO();
$Categorias = new Config\Categorias_DAO();

$result = $Imovel->getList();
$imoveis = $result[0];
?>
<div class="lista">
    <table style="font-family:sans-serif;">
        <?php
        foreach ($imoveis as $imovel):

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

            $corCategoria = $Categorias->getList("WHERE categoria = '{$categoria}'");
            $corCategoria = $corCategoria[0]['cor'];
            ?>
            <tr>
                <td><?= $ref; ?></td>
                <td style="background:#<?= $corCategoria; ?>; border:none; color:#FFF"><?= $categoria; ?></td>
                <td><?= $endereco . ", " . $numero . " - " . $bairro . " - " . $cep; ?></td>
                <td><span >R$ <?= $valor; ?></span></td>
                <td><span ><?= $status; ?></span></td>
            </tr>
            <?php
        endforeach;
        ?>
    </table>
</div>