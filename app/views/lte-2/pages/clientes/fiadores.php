<?php

use App\Models\Clientes as Clientes;
use Lib\Classes as Classes;

if ($_GET['id'] == ''):

    $URL = new Classes\URL();
    $Fiadores = new Clientes\Fiadores_DAO();
    $result = $Fiadores->getList();
    ?>
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Fiadores</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="lista" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Fiador</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $fiad):
                        $id = $fiad['id'];
                        $nome = $fiad['nome'];
                        $endereco = str_replace(" , ", ", ", $fiad['endereco']);
                        $contato = $fiad['contato'];
                        $email = mb_tolower($fiad['email']);
                        ?>
                        <tr id="<?= $id ?>">
                            <td><a href="<?= URL_ROOT; ?>clientes/fiadores/detalhes?f=<?= $id ?>" ><?= mb_ucwords($nome); ?></a></td>
                            <td><?= mb_ucwords($endereco); ?></td>
                            <td><?= $contato; ?></td>
                            <td>
                                <?php
                                if (permissao('fiador_edit')):
                                    ?>
                                    <a href="<?= URL_ROOT; ?>clientes/fiadores/editar?f=<?= $id; ?>">
                                        <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                                    </a>
                                    <?php
                                endif;
                                if (permissao('fiador_del')):
                                    ?>
                                    <a href="#" onClick="excluir_fiador('<?= $id; ?>')" >
                                        <img src="<?= DIR_IMG; ?>delete.png" style="margin-right:10px;" />
                                    </a>	
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
        </div><!-- /.box-body -->

        <div class="box-footer">
            <?php if (permissao('fiador_cad')): ?>
                <a href="<?= URL_ROOT; ?>clientes/fiadores/cadastrar" class="btn btn-flat bg-olive">
                    <i class="fa fa-plus"></i> Cadastrar Fiador
                </a>
                <?php
            endif;
            ?>
        </div>
    </div><!-- /.box -->
    <?php
elseif ($_GET['id'] == 'cadastrar'):

    if (permissao('fiador_cad')):
        include('_cad_fiador.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;


elseif ($_GET['id'] == 'editar'):

    if (permissao('fiador_edit')):
        include('_edit_fiador.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;
elseif ($_GET['id'] == 'detalhes'):
    
    include('_detalhes_fiador.php');
    
endif;
?>
