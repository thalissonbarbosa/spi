<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Categorias = new Config\Categorias_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Categorias</span>
    </div>

    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="insert_categoria" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="categoria" id="categoria" autofocus required  />
                        </div>
                        <div class="form-group">
                            <label>Cor</label>
                            <input type="text" class="form-control colorPicker" name="cor" />
                        </div>

                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />
                    </form>
                </div>
                <div class="col-md-2"></div>

                <div class="col-md-4">
                    <?php
                    $result = $Categorias->getList();
                    ?> 
                    <table class="table table-hover table-striped">  
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhuma categoria cadastrada.";
                            else:
                                foreach ($result as $categoria):
                                    $nomeCategoria = $categoria['categoria'];
                                    $idCategoria = $categoria['id'];
                                    $corCategoria = $categoria['cor'];
                                    ?>
                                    <tr id="<?= mb_tolower($nomeCategoria); ?>">
                                        <td>
                                            <?= mb_ucwords($nomeCategoria); ?> 
                                            <span class="label pull-right" style="background:#<?= $corCategoria; ?>;">Cor - <?= '#' . $corCategoria; ?></span>
                                        </td>
                                        <td class="text-right">
                                            <a class="excluir" href="<?= URL_ROOT; ?>configuracoes/categorias/editar?i=<?= $idCategoria; ?>"  style="margin-right:15px;">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a> 
                                            <a href="#" onClick="excluir_categorias('<?= $idCategoria ?>', '<?= $nomeCategoria; ?>')">
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
            $categorias = $Categorias->get(_GetInt('i'));
            $nome = $categorias['categoria'];
            $cor = $categorias['cor'];
            $id = $categorias['id'];
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="update_categoria" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="<?= $nome; ?>" name="categoria" id="categoria" autofocus required  />
                        </div>
                        <div class="form-group">
                            <label>Cor</label>
                            <input type="text" class="form-control colorPicker" value="#<?= $cor; ?>" name="cor" />
                        </div>

                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/categorias';" />
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-6 text-center text-red">
                    <p class="lead">
                        <i class="fa fa-exclamation-triangle"></i> ATENÇÃO: 
                        <br /> A alteração desses valores terá efeito também nos Imóveis já cadastrados.
                    </p>
                </div>

            </div>
            <?php
        endif;
        ?>
    </div>
</div>