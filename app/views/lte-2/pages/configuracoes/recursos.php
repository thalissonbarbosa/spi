<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Recursos = new Config\Recursos_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Recursos</span>
    </div>
    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">

                <div class="col-md-4">
                    <form id="insert_recurso" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="recurso" autofocus required  />
                        </div>

                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3">
                    <?php
                    $result = $Recursos->getList();
                    ?> 
                    <table class="table table-hover table-striped">   
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhum recurso cadastrado.";
                            else:
                                $i = 0;
                                foreach ($result as $recurso):
                                    $nome_recurso = $recurso['nome'];
                                    $id_recurso = $recurso['id'];

                                    if ($i > 20):
                                        $i = 0;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        <?php
                                    endif;
                                    ?>
                                    <tr id="<?= $id_recurso; ?>">
                                        <td><?= mb_ucwords($nome_recurso); ?> </td>

                                        <td class="text-right">
                                            <a href="<?= URL_ROOT; ?>configuracoes/recursos/editar?i=<?= $id_recurso; ?>" style="margin-right:10px;">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a> 
                                            <a href="#" onClick="excluir_recursos('<?= $id_recurso ?>', '<?= $nome_recurso; ?>')" >
                                                <img src="<?= DIR_IMG; ?>delete.png" />
                                            </a> 
                                        </td>
                                    </tr>
                                    <?php
                                    $i += 1;
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        elseif ($_GET['id'] == 'editar'):
            $recursos = $Recursos->get(_GetInt('i'));
            $nome = $recursos['nome'];
            $id = $recursos['id'];
            ?>
            <div class="row">

                <div class="col-md-4">
                    <form id="update_recurso" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" value="<?= $nome; ?>" class="form-control" name="recurso" autofocus required  />
                        </div>

                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/recursos';" />
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-6 text-center text-red">
                    <h4>
                        <i class="fa fa-exclamation-triangle"></i> ATENÇÃO: 
                        <br /> A alteração desses valores terá efeito também nos Imóveis já cadastrados.
                    </h4>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>