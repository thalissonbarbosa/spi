<?php

use Lib\Classes as Classes;

$id = _GetInt('id');

$Atendimento = new App\Models\Atendimento();

$Detalhes = $Atendimento->get($id);

// Se o id não existe no banco
if ($Detalhes == null) {
    Classes\Messages::setMsg('Não foi possível exibir o conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
}

// Dados Atendimento
$imovel_categoria = substr($Detalhes['imovel_categoria'], 0, strlen($Detalhes['imovel_categoria']) - 2);
$zona = substr($Detalhes['zona'], 0, strlen($Detalhes['zona']) - 2);
$date = date_format(new DateTime($Detalhes['data']), 'd/m/Y H:i');
$date = explode(" ", $date);

if ($Detalhes['interesse'] != "Imóvel") {
    $imovel_options_display = "style='display:none;'";
}else{
    $imovel_options_display = null;
}
?>

<div class="box">
    <div class="box-header with-border">
        <span class="box-title text-light-blue">
            Atendimento #<?= str_pad($Detalhes['id'], 4, 0, STR_PAD_LEFT); ?>
            <br /> 
            <small class="text-muted"><i class="fa fa-history"></i> <?= $Detalhes['usuario'] . " - " . $date[0], " às ", $date[1]; ?></small>
        </span>

        <div class="box-tools pull-right">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="text-muted lead"><i class="fa fa-gear"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="text-left">
                        <?php if (permissao('atendimento_edit')):
                            ?>
                            <a href="<?= URL_ROOT; ?>atendimento/editar/<?= $id; ?>">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                            <?php
                        endif;
                        ?>
                    </li>
                    <li class="text-left">
                        <?php
                        if (permissao('atendimento_del')):
                            ?>
                            <a href="#" onClick="excluir_atendimento('<?= $id; ?>', true)">
                                <i class="fa fa-times"></i> Excluir
                            </a>
                        <?php endif;
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">

                <div class="box no-border ">
                    <div class="box-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Nome</strong><span class="pull-right"><?= $Detalhes['nome']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>E-mail</strong><span class="pull-right"><?= $Detalhes['email'] ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Tel/Celular</strong><span class="pull-right"><?= $Detalhes['tel']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Tel/Comercial</strong><span class="pull-right"><?= $Detalhes['tel_comercial']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Como Conheceu</strong><span class="pull-right"><?= $Detalhes['conheceu']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Interesse</strong><span class="pull-right"><?= $Detalhes['interesse']; ?></span>
                            </li>
                            <div class="imovel-options" <?= $imovel_options_display; ?>>
                                <li class="list-group-item">
                                    <strong>Interesse</strong><span class="pull-right"><?= $imovel_categoria; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tipo</strong><span class="pull-right"><?= $Detalhes['tipo']; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>De</strong><span class="pull-right text-olive"><?= "R$ " . nformat($Detalhes['valor_de']); ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ate</strong><span class="pull-right text-olive"><?= "R$ " . nformat($Detalhes['valor_ate']); ?></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Zona</strong><span class="pull-right"><?= $zona; ?></span>
                                </li>
                            </div>
                            <li class="list-group-item">
                                <strong>Observação</strong><br /><span><?= mb_ucfirst(mb_tolower(stripslashes($Detalhes['obs']))); ?></span>
                            </li>
                        </ul>
                    </div> <!-- ./box-body -->
                </div> <!-- ./box -->
            </div> <!-- ./col-md-4 -->

            <div class="col-md-8" <?= $imovel_options_display; ?>>
                <div class="box no-border">

                    <div class="box-header text-center">
                        <span class="box-title"><i class="fa fa-exclamation-circle"></i> Possíveis Imóveis de Interesse</span>
                    </div> <!-- ./box-header -->

                    <div class="box-body ">

                        <ul class="list-group list-group-unbordered">
                            <?php
                            $PossiveisImoveis = $Atendimento->listaPossiveisImoveis();

                            if (empty($PossiveisImoveis)):
                                echo '<span class="text-center">No momento não há nenhum imóvel com estes requisitos.</span>';
                            else:
                                foreach ($PossiveisImoveis as $imovel):

                                    // Dados
                                    $numero = Classes\CamposDefault::numero($imovel['numero']);
                                    $categoria = mb_ucwords($imovel['categoria']);
                                    $status = mb_ucwords($imovel['stats']);
                                    ?>
                                    <a href="<?= URL_ROOT ?>imovel/detalhes/<?= $imovel['codigo']; ?>" target="_blank">
                                        <li class="list-group-item bg-light-gray text-light-blue" style="margin-bottom:5px;">
                                            <?= (!empty($imovel['ref'])) ? $imovel['codigo'] . ' - ' . '<small>#' . $imovel['ref'] . '</small>' : $imovel['codigo']; ?>
                                            <?=
                                            " - " . $categoria . " - " . $imovel['endereco'] . ", " . $numero . " - " . $imovel['bairro']
                                            . " - " . $imovel['zona'] . " - " . $imovel['cep'];
                                            ?>
                                            <small class="text-olive">
                                                <?= $imovel['condominio']; ?>
                                            </small>
                                            <span class="text-olive pull-right">
                                                <?= "R$ " . nformat($imovel['valor']); ?>
                                            </span>
                                        </li>
                                    </a>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div> <!-- ./box-body -->

                </div>
            </div> <!-- ./col-md-8 -->

        </div>
    </div>
</div>
