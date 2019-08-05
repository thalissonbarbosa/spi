<?php

use App\Models as Models;
use App\Models\Imovel as Imovel;
use App\Models\Clientes as Clientes;
use Lib\Classes as Classes;

$Proprietarios = new Clientes\Proprietarios_DAO();
$Locatarios = new Clientes\Locatarios_DAO();

$LocatariosImovel = new Imovel\Locatarios_DAO();
$ProprietariosImovel = new Imovel\Proprietarios_DAO();
$Galeria = new Imovel\Galeria_DAO();

$Imovel = new Imovel\Imovel_DAO();
$result = $Imovel->get();

if (!$result):
    Classes\Messages::setMsg('Não foi possível encontrar este imóvel.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

// Setando os dados do imóvel
$id = $result['id'];
$ref = $result['ref'];
$codigo = $result['codigo'];

$valor = nformat($result['valor']);
$endereco = mb_ucwords($result['endereco']);
$bairro = mb_ucwords($result['bairro']);
$numero = Classes\CamposDefault::numero($result['numero']);
$cidade = mb_ucwords($result['cidade']);
$zona = mb_ucwords($result['zona']);
$cep = $result['cep'];

$imgPrincipal = Classes\CamposDefault::imgPrincipal($result['imagemPrincipal'], $codigo);
$img_nome = $result['imagemPrincipal'];

$tipo = mb_ucwords($result['tipo']);
$obs = mb_ucfirst(mb_tolower(stripslashes($result['obs'])));   //$obs = 			mb_ucwords($obs);
$condominio = mb_ucwords($result['condominio']);
$taxaCond = Classes\CamposDefault::taxaCond($result['taxaCond']);
$nchave = $result['nchave'];
$napt = $result['napt'];
$corretor = mb_ucwords($result['corretor']);
$categoria = mb_ucwords(Classes\CamposDefault::categoria($result['categoria']));
$status = mb_ucwords(Classes\CamposDefault::status($result['stats']));

// Pegando cor da Categoria do imóvel
$query = "SELECT cor FROM config_categoria WHERE categoria = :categoria";
$Imovel->query($query);
$Imovel->bind(':categoria', $categoria);
$Imovel->execute();
$cor = $Imovel->result();
$corCategoria = Classes\CamposDefault::cor($cor['cor']);

// Pegando cor do Status do imóvel
$query = "SELECT cor FROM config_stats WHERE stats = :status";
$Imovel->query($query);
$Imovel->bind(':status', $status);
$Imovel->execute();
$cor = $Imovel->result();
$corStatus = Classes\CamposDefault::cor($cor['cor']);
?>

<!-- Upload Img Principal / status upload -->
<div>
    <?php
    if (isset($_POST['uploadPrincipal'])):
        // recebe o resultado do upload
        $resultUploadPrincipal = $Galeria->uploadPrincipal($codigo);
        // se a imgem existir substitui a atual
        if (is_array($resultUploadPrincipal)):
            $imgPrincipal = $resultUploadPrincipal['img'];
        endif;
    endif;
    ?>
</div>

<div class="box">

    <div class="box-header with-border">
        <span class="box-title text-purple"><?= (!empty($ref)) ?  $codigo . ' - ' . '<small>#' . $ref . '</small>' : $codigo; ?></span>

        <div class="box-tools pull-right">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle lead text-purple" data-toggle="dropdown"><i class="fa fa-gear"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#" data-toggle="modal" data-target="#modal-mais-detalhes"><i class="fa fa-plus-square"></i> Mais Detalhes</a></li>

                    <li role="separator" class="divider"></li>

                    <li><a href="<?= URL_ROOT; ?>imovel/editar/<?= $codigo; ?>" ><i class="fa fa-pencil-square"></i> Editar</a></li>
                    <?php
                    if (permissao('imovel_del')) {
                        if ($status == "Desabilitado") {
                            ?>
                            <li><a href="#" onClick="enable_imovel('<?= $codigo ?>')" ><i class="fa fa-check-square"></i> Habilitar</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="#" onClick="disable_imovel('<?= $codigo; ?>')" ><i class="fa fa-minus-square"></i> Desabilitar</a></li>
                            <?php
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>

    </div> <!-- ./box-header geral -->

    <div class="box-body">

        <div class="row">

            <div class="col-md-4">

                <div class="with-caption">
                    <div class="box-img text-center" style="width:400px; height: 300px;">
                        <a class="fancybox" href="<?= DIR_IMG . $imgPrincipal; ?>" > 
                            <img src="<?= DIR_IMG . $imgPrincipal; ?>" class="img-thumbnail img-responsive" />
                        </a>
                    </div>

                    <?php if (permissao('imovel_edit')): ?>
                        <!-- caption hover -->
                        <div class="caption no-background" style="height:0; opacity: 0.6; clear:both; margin-top:62%; padding: 5px">
                            <!-- Input file img principal -->
                            <form id="editar_imagem" class="bg-black" style="" action="" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="uploadPrincipal" />
                                <label for="arquivo" style="width:100%;">
                                    <h5 class="cursor-pointer"><i class="fa fa-camera"></i> Alterar Imagem</h5>
                                    <input type="file" id="arquivo" name="arquivo" class="editar_imagem" onChange="this.form.submit(); waitingFor(true)" style="display: none" /> 
                                </label>
                            </form>
                        </div>
                        <div class="caption" style="opacity: 0.6; width:30px; height:30px">
                            <!-- Botao Excluir -->
                            <a href="#" onCLick="deleteImgPrincipal('<?= $codigo; ?>', '<?= $img_nome; ?>');">
                                <span class="lead bg-black pull-right cursor-pointer" style="padding:5px 10px;"><i class="fa fa-trash"></i></span>
                            </a>
                        </div> 
                    <?php endif; ?>
                </div><!-- ./with-caption -->
                <h4>
                    <span class="no-border-radius label label-lg center-block" style="background:#<?= $corCategoria; ?>;"><?= $categoria; ?></span>
                    <span class="no-border-radius label label-lg center-block" style="background:#<?= $corStatus; ?>; margin-top:5px"><?= $status; ?></span>
                    <span class="no-border-radius label label-lg center-block bg-light-gray" style="margin-top:5px" >R$ <?= $valor; ?></span>
                    <span class="no-border-radius label label-lg center-block bg-light-gray" style="margin-top:5px" ><?= $tipo; ?></span>
                </h4>

            </div> <!-- ./col-md-4 -->

            <div class="col-md-8">

                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Endereço: </strong>
                        <span class="text-light-blue "><?= $endereco . ", " . $numero . " - " . $bairro . " , " . $cep . " - Zona " . $zona . " - " . $cidade; ?></span>
                    </li>
                    <li class="list-group-item" style="min-height:40px">
                        <strong >Obs: </strong>
                        <span class="text-light-blue"><?= $obs; ?></span>
                    </li>
                </ul>

                <div class="row ">

                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Condomínio/Edifício: </strong>
                                <span class="text-light-blue "><?= $condominio; ?></span>
                            </li>

                            <li class="list-group-item">
                                <strong>Taxa Cond.: </strong>
                                <span class="text-light-blue "><?= $taxaCond; ?></span>
                            </li>

                            <li class="list-group-item">
                                <strong>Corretor: </strong>
                                <span class="text-light-blue "><?= $corretor; ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Nº Apt.: </strong>
                                <span class="text-light-blue "><?= $napt; ?></span>
                            </li>

                            <li class="list-group-item">
                                <strong>Nº Chave: </strong>
                                <span class="text-light-blue "><?= $nchave; ?></span>
                            </li>
                        </ul>
                    </div>

                </div> <!-- ./row detalhe endereço --> 

                <div class="box">
                    <div class="box-header with-border">
                        <span class="box-title">Atributos</span>
                        <?php
                        // Botao para adicionar mais atributos
                        if (permissao('imovel_edit')): // Verificando Permissão para adicionar   
                            ?>
                            <a href="#" data-toggle="modal" data-target="#modal-add-atributos" class="pull-right text-purple">
                                <span class="lead"><i class="fa fa-plus"></i></span>
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>

                    <div class="box-body">
                        <?php
                        $Atributos = new Imovel\Atributos_DAO();
                        $atributos = $Atributos->getListFrom($codigo);

                        // Exibindo Atributos do imóvel
                        if (count($atributos) == 0):
                            echo "<span class='text-muted'>Nenhum atributo adicionado...</span>";
                        else:
                            ?>
                            <ul class="list-unstyled pull-left" style="margin-right:15px;">
                                <?php
                                $count = 0;
                                foreach ($atributos as $atributo):
                                // Pegando os atributos que o imóvel tem
                                for ($i = 0; $i < 1; $i++):
                                    $nome[$i] = $atributo['nome'];
                                    $nome[$i] = mb_ucwords($nome[$i]);
                                    $quantidade[$i] = $atributo['quantidade'];
                                    $atributo_id = $atributo['id_atributo']
                                    ?>
                                    <div id="atributo-<?= $atributo_id; ?>" class="panel panel-default pull-left text-center" style="margin-right:10px;">
                                        <div class="panel-heading">
                                            <?= $nome[$i]; ?> 
                                        </div>
                                        <div class="panel-body with-caption">
                                            <?= $quantidade[$i]; ?>
                                            <div class="caption">
                                                <a href="#" class="text-gray" onCLick="delete_atributo('<?= $atributo_id; ?>', '<?= $codigo; ?>')">
                                                    <h3 style="margin-top:15px;"><i class="fa fa-trash"></i></h3>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endfor;
                            endforeach;
                                ?>
                            </ul>
                        <?php
                        endif;
                        ?>

                    </div> <!-- ./box-body-atributos -->

                </div> <!-- ./atributos -->

                <div class="box">
                    <div class="box-header with-border">
                        <span class="box-title">Recursos</span>
                        <?php
                        if (permissao('imovel_edit')): // Verificando Permissão para adicionar   
                            ?>
                            <a href="#" data-toggle="modal" data-target="#modal-add-recursos" class="pull-right text-purple">
                                <span class="lead"><i class="fa fa-plus"></i></span>
                            </a>
                            <?php
                        endif;
                        ?>
                    </div>

                    <div class="box-body">
                        <?php
                        $Recursos = new Imovel\Recursos_DAO();
                        $recursos = $Recursos->getListFrom($codigo);

                        if (count($recursos) == 0):
                            echo "<span class='text-muted'>Nenhum recurso adicionado...</span>";
                        else:
                            ?>
                            <ul class="list-unstyled pull-left" style="margin-right:15px;">
                                <?php
                                $count = 0;
                                foreach ($recursos as $recurso):
                                    if ($count > 4):
                                        ?>
                                    </ul>
                                    <ul class="list-unstyled pull-left" style="margin-right:15px;">
                                        <?php
                                        $count = 0;
                                    endif;
                                    // Pegando os recursos do imóvel
                                    for ($i = 0; $i < 1; $i++):
                                        $nomeRecurso[$i] = $recurso['nome'];
                                        $nomeRecurso[$i] = mb_ucwords($nomeRecurso[$i]);
                                        ?>
                                        <li><span class="text-olive"><i class="fa fa-check-circle"></i></span> <?= $nomeRecurso[$i]; ?></li>

                                        <?php
                                    endfor;
                                    $count += 1;
                                endforeach;
                                ?>
                            </ul>
                        <?php
                        endif;
                        ?>
                    </div>

                </div> <!-- ./recursos -->

            </div> <!-- ./col-md-8 -->

        </div> <!-- ./row -->

        <!-- upload galeria / status upload -->
        <span class="statusUploadGaleria">
            <?php
            if (isset($_POST['upload'])):
                $Galeria->uploadGaleria($codigo);
            endif;
            ?>
        </span>

        <div class="box" id="galeria">

            <div class="box-header">
                <span class="box-title">Imagens</span>
                <?php
                if (permissao('imovel_edit')):
                    ?>
                    <form class="upload_galeria pull-right" method="POST" action="#galeria" enctype="multipart/form-data" >
                        <input type="hidden" name="upload" /> 
                        <label for="arquivos">
                            <span class="lead text-purple cursor-pointer"><i class="fa fa-folder-open"></i></span>
                            <input type="file" name="arquivos[]" id="arquivos" multiple onChange="this.form.submit(); waitingFor(true)" style="display: none" />
                        </label>
                    </form>
                    <?php
                endif;
                ?>
            </div> <!-- ./box-header galeria -->

            <div class="box-body">
                <?php
                $galeria = $Galeria->getListFrom($codigo);

                if (count($galeria) == 0):
                    echo "<span>Nenhuma imagem adicionada...</span>";
                else:
                    foreach ($galeria as $imagem):
                        $img = $imagem['imagem'];
                        $img_id = $imagem['id'];
                        ?>
                        <div id="img-id-<?= $img_id; ?>" class="img-galeria with-caption pull-left" style="max-width:200px; height:150px; margin-right: 10px;">
                            <a class="fancybox" rel="gallery" href="<?= DIR_IMG; ?>imoveis/<?= $codigo . "/" . $img; ?>" > 
                                <img class="img-thumbnail img-responsive" src=<?= DIR_IMG; ?>imoveis/<?= $codigo . "/" . $img; ?> style="height:100%;" />
                            </a>
                            <!-- Botão excluir -->
                            <?php if (permissao('imovel_edit')): ?>
                                <div class="caption no-background" style="width:50px; height:50px">
                                    <a href="#galeria" onCLick="deleteImgGaleria('<?= $img_id; ?>', '<?= $codigo; ?>', '<?= $img; ?>')">
                                        <span class="lead bg-black pull-right" style="padding:5px 10px;"><i class="fa fa-trash"></i></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div> <!-- ./box-body galeria -->

            <div class="box-footer">
                <!-- Excluir Tudo -->
                <?php if (permissao('imovel_edit') && count($galeria) > 0): ?>
                    <button class="btn btn-flat bg-red pull-right" onClick="delete_galeria('<?= $codigo ?>')"><i class="fa fa-trash"></i> Excluir Galeria</button>
                <?php endif; ?>
            </div> <!-- ./box-footer galeria -->

        </div> <!-- ./box galeria -->

    </div> <!-- ./box-body geral -->

    <div class="box-footer">

    </div> <!-- ./box-footer geral -->

</div> <!-- ./box geral-->