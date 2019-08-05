<?php

use App\Models\Clientes as Clientes;

$Locatarios = new Clientes\Locatarios_DAO();
$Fiadores = new Clientes\Fiadores_DAO();
$Proprietarios = new Clientes\Proprietarios_DAO();

$locatarios = $Locatarios->getList();
$fiadores = $Fiadores->getList();
$proprietarios = $Proprietarios->getList();
?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
                <h3><?= count($proprietarios); ?></h3>

                <p>Proprietários</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?= URL_ROOT; ?>clientes/proprietarios" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
                <h3><?= count($locatarios); ?></h3>

                <p>Locatários</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?= URL_ROOT; ?>clientes/locatarios" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
            <div class="inner">
                <h3><?= count($fiadores); ?></h3>

                <p>Fiadores</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?= URL_ROOT; ?>clientes/fiadores" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>
<!-- /.row -->

<div class="box box-warning">
    <div class="box-header with-border">
        <span class="box-title">Proprietários</span>
    </div>

    <div class="box-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($proprietarios as $prop):
                    if ($i > 5):
                        break;
                    endif;
                    
                    $id = $prop['id'];
                    $nome = $prop['nome'];
                    if ($prop['endereco'] == ' ,  ,  ,  ,  , '):
                        $endereco = '';
                    else:
                        $endereco = str_replace(" , ", ", ", $prop['endereco']);
                    endif;

                    $contato = $prop['contato'];
                    $email = mb_tolower($prop['email']);
                    ?>
                    <tr id="<?= $id ?>">
                        <td><a href="<?= URL_ROOT; ?>clientes/proprietarios/detalhes?p=<?= $id; ?>" ><?= mb_ucwords($nome); ?></a></td>
                        <td><?= mb_ucwords($endereco); ?></td>
                        <td><?= $contato; ?></td>
                    </tr>
                    <?php
                    $i += 1;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="box-footer">
        <a href="<?= URL_ROOT; ?>clientes/proprietarios" class="btn btn-flat btn-default pull-right">Ver todos</a>
    </div>
</div>

<div class="box box-warning">
    <div class="box-header with-border">
        <span class="box-title">Locatários</span>
    </div>

    <div class="box-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($locatarios as $loca):
                    if ($i > 5):
                        break;
                    endif;
                    
                    $id = $loca['id'];
                    $nome = $loca['nome'];
                    if ($loca['endereco'] == ' ,  ,  ,  ,  , '):
                        $endereco = '';
                    else:
                        $endereco = str_replace(" , ", ", ", $loca['endereco']);
                    endif;

                    $contato = $loca['contato'];
                    $email = mb_tolower($loca['email']);
                    ?>
                    <tr id="<?= $id ?>">
                        <td><a href="<?= URL_ROOT; ?>clientes/locatarios/detalhes?l=<?= $id; ?>" ><?= mb_ucwords($nome); ?></a></td>
                        <td><?= mb_ucwords($endereco); ?></td>
                        <td><?= $contato; ?></td>
                    </tr>
                    <?php
                    $i += 1;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="box-footer">
        <a href="<?= URL_ROOT; ?>clientes/locatarios" class="btn btn-flat btn-default pull-right">Ver todos</a>
    </div>
</div>

<div class="box box-warning">
    <div class="box-header with-border">
        <span class="box-title">Fiadores</span>
    </div>

    <div class="box-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($fiadores as $fiad):
                    if ($i > 5):
                        break;
                    endif;
                    
                    $id = $fiad['id'];
                    $nome = $fiad['nome'];
                    if ($fiad['endereco'] == ' ,  ,  ,  ,  , '):
                        $endereco = '';
                    else:
                        $endereco = str_replace(" , ", ", ", $fiad['endereco']);
                    endif;

                    $contato = $fiad['contato'];
                    $email = mb_tolower($fiad['email']);
                    ?>
                    <tr id="<?= $id ?>">
                        <td><a href="<?= URL_ROOT; ?>clientes/fiadores/detalhes?f=<?= $id; ?>" ><?= mb_ucwords($nome); ?></a></td>
                        <td><?= mb_ucwords($endereco); ?></td>
                        <td><?= $contato; ?></td>
                    </tr>
                    <?php
                    $i += 1;
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="box-footer">
        <a href="<?= URL_ROOT; ?>clientes/fiadores" class="btn btn-flat btn-default pull-right">Ver todos</a>
    </div>
</div>
