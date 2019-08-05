<?php

use App\Models\Clientes as Clientes;
use Lib\Classes as Classes;

if ($_GET['id'] == ''):

    $URL = new Classes\URL();
    $Locatarios = new Clientes\Locatarios_DAO();
    $result = $Locatarios->getList();
    ?>
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Locatários</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="lista" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Locatário</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $loca):
                        $id = $loca['id'];
                        $nome = $loca['nome'];
                        $endereco = str_replace(" , ", ", ", $loca['endereco']);
                        $contato = $loca['contato'];
                        $email = mb_tolower($loca['email']);
                        ?>
                        <tr id="<?= $id ?>">
                            <td style="width:30%;"><a href="<?= URL_ROOT; ?>clientes/locatarios/detalhes?l=<?= $id ?>" ><?= mb_ucwords($nome); ?></a></td>
                            <td style="min-width:50%;"><?= mb_ucwords($endereco); ?></td>
                            <td><?= $contato; ?></td>
                            <td>
                                <?php
                                if (permissao('locatario_edit')):
                                    ?>
                                    <a href="<?= URL_ROOT; ?>clientes/locatarios/editar?l=<?= $id; ?>">
                                        <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                                    </a>
                                    <?php
                                endif;
                                if (permissao('locatario_del')):
                                    ?>
                                    <a href="#" onClick="javascript: excluir_locatario('<?= $id; ?>')" >
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
            <?php if (permissao('locatario_cad')): ?>
                <a href="<?= URL_ROOT; ?>clientes/locatarios/cadastrar" class="btn btn-flat bg-olive">
                    <i class="fa fa-plus"> </i> Cadastrar Locatário
                </a>
                <?php
            endif;
            ?>
        </div>
    </div><!-- /.box -->

    <?php
elseif ($_GET['id'] == 'cadastrar'):

    if (permissao('locatario_cad')):
        include('_cad_locatario.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;


elseif ($_GET['id'] == 'editar'):

    if (permissao('locatario_edit')):
        include('_edit_locatario.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;
elseif ($_GET['id'] == 'detalhes'):
    
    include('_detalhes_locatario.php');
    
endif;
?>
