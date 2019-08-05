<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Usuarios = new Config\Usuarios_DAO();
?>
<div class="box">
    <div class="box-header with-border">
        <span class="box-title"><i class="fa fa-gear"></i> Usuários</span>
    </div>

    <?php
    if ($_GET['id'] == ''):
        ?>

        <?php
        $result = $Usuarios->getList();
        ?>
        <div class="box-body">
            <table class="table table-responsive table-hover table-bordered table-striped">
                <thead>
                <th>Nome</th>
                <th>Login</th>
                <th class="hidden-xs">E-mail</th>
                <th class="hidden-xs">Tipo</th>
                <th></th>
                </thead> 
                <tbody>
                    <?php
                    if (count($result) == 0):
                        echo "<td>Nenhum usuaário cadastrado.</td><td></td><td></td>";
                    else:
                        foreach ($result as $user):
                            $id = $user['id'];
                            $nome = $user['nome'];
                            $login = $user['login'];
                            $email = $user['email'];
                            $tipo = $user['tipo'];
                            ?>
                            <tr id="<?= $id; ?>">
                                <td><?= mb_ucwords($nome); ?></td>
                                <td><?= mb_tolower($login); ?></td>
                                <td class="hidden-xs"><?= mb_tolower($email); ?></td>
                                <td class="hidden-xs"><?= mb_ucwords($tipo); ?></td>

                                <td class="text-right">

                                    <?php if (permissao('imovel_config')):
                                        ?>

                                        <a href="<?= URL_ROOT; ?>configuracoes/usuarios/editar?i=<?= $id; ?>">
                                            <img src="<?= DIR_IMG; ?>edit.png" style="margin-right:10px;" />
                                        </a>
                                        <a href="#" onClick="javascript: delete_usuario('<?= $id ?>', '<?= $login; ?>')" style="margin-right:10px;">
                                            <img src="<?= DIR_IMG; ?>delete.png" />
                                        </a>
                                    <?php endif;
                                    ?>		
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>

        <div class="box-footer">
            <a href="<?= URL_ROOT; ?>configuracoes/usuarios/cadastrar" class="btn btn-flat bg-olive"><i class="fa fa-plus"></i> Cadastrar Usuário</a>
        </div>
        <?php
    elseif ($_GET['id'] == 'editar' && isset($_GET['i'])):

        include ("_editar_usuario.php");

    elseif ($_GET['id'] == 'cadastrar'):

        include ("_cadastrar_usuario.php");

    endif;
    ?>

</div>