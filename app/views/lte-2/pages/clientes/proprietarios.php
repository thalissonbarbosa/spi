<?php

use App\Models\Clientes as Clientes;
use Lib\Classes as Classes;

$id = $_GET['id'];
if ($id == ''):

    $URL = new Classes\URL();
    $Proprietarios = new Clientes\Proprietarios_DAO();

    $result = $Proprietarios->getList();
    ?>
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Proprietários</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="lista" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Proprietário</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $prop):
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
                            <td><a href="<?= URL_ROOT; ?>clientes/proprietarios/detalhes?p=<?= $id ?>" ><?= mb_ucwords($nome); ?></a></td>
                            <td><?= mb_ucwords($endereco); ?></td>
                            <td><?= $contato; ?></td>
                            <td>
                                <?php
                                if (permissao('proprietario_edit')):
                                    ?>
                                    <a href="<?= URL_ROOT; ?>clientes/proprietarios/editar?p=<?= $id; ?>">
                                        <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                                    </a>
                                    <?php
                                endif;
                                if (permissao('proprietario_del')):
                                    ?>
                                    <a href="#" onClick="javascript: excluir_proprietario('<?= $id; ?>')" >
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
            <?php if (permissao('proprietario_cad')): ?>
                <a href="<?= URL_ROOT; ?>clientes/proprietarios/cadastrar" class="btn btn-flat bg-olive">
                    <i class="fa fa-plus"> </i> Cadastrar Proprietário
                </a>
                <?php
            endif;
            ?>
        </div>
    </div><!-- /.box -->

    <?php
elseif ($id == 'cadastrar'):

    if (permissao('proprietario_cad')):
        include('_cad_proprietario.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;

elseif ($id == 'editar'):

    if (permissao('proprietario_edit')):
        include('_edit_proprietario.php');
    else:
        Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
        Classes\Messages::getMsg();
    endif;

elseif ($id == 'detalhes'):
    
    include('_detalhes_proprietario.php');
    
endif;
?>
