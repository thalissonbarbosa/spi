<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Tipos = new Config\Tipos_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Tipos</span>
    </div>
    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="insert_tipo" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="tipo" autofocus required  />
                        </div>

                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />   
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <?php
                    $result = $Tipos->getList();
                    ?> 
                    <table class="table table-hover table-striped">  
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhum tipo cadastrado.";
                            else:
                                foreach ($result as $tipo):
                                    $nome_tipo = $tipo['tipo'];
                                    $id_tipo = $tipo['id'];
                                    ?>
                                    <tr id="<?= $id_tipo; ?>">
                                        <td><?= mb_ucwords($nome_tipo); ?> </td>
                                        <td class="text-right">
                                            <a id="<?= $id_tipo; ?>" href="<?= URL_ROOT; ?>configuracoes/tipos/editar?i=<?= $id_tipo; ?>" style="margin-right:10px;">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a> 
                                            <a href="#" onClick="javascript: excluir_tipos('<?= $id_tipo ?>', '<?= $nome_tipo; ?>')">
                                                <img src="<?= DIR_IMG; ?>delete.png" />
                                            </a> 

                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <?php
        elseif ($_GET['id'] == 'editar'):

            $tipos = $Tipos->get(_GetInt('i'));
            $id = $tipos['id'];
            $nome = mb_ucwords($tipos['tipo']);
            ?>

            <div class="row">
                <div class="col-md-4">
                    <form id="update_tipo" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="<?= $nome; ?>" name="tipo" autofocus required  />
                        </div>
                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/tipos';" />   
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-6 text-center text-red">
                    <h4><i class="fa fa-exclamation-triangle"></i> ATENÇÃO: <br /> A alteração desses valores terá efeito também nos Imóveis/Serviços já cadastrados.</h4>
                </div>
            </div>

            <?php
        endif;
        ?>
    </div>
</div>