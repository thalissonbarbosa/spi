<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Atributos = new Config\Atributos_DAO();
?>
<div class="box">
    <div class="box-header with-border">
        <span class="box-title"><i class="fa fa-gear"></i> Atributos</span>
    </div>

    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>

            <div class="row">
                <div class="col-md-4">
                    <form id="insert_atributo" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="atributo" class="form-control" autofocus required  />
                        </div>
                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes';" />
                    </form>
                </div>

                <div class="col-md-2"></div>

                <div class="col-md-4">
                    <?php
                    $result = $Atributos->getList();
                    ?> 
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <tbody>
                                <?php
                                if (count($result) == 0):
                                    echo "Nenhum atributo cadastrado.";
                                else:
                                    foreach ($result as $atributo):
                                        $nome_atributo = $atributo['nome'];
                                        $id_atributo = $atributo['id'];
                                        ?>
                                        <tr id="<?= mb_tolower($nome_atributo); ?>">
                                            <td>
                                                <?= mb_ucwords($nome_atributo); ?> 
                                            </td>
                                            <td class="text-right">

                                                <a href="<?= URL_ROOT; ?>configuracoes/atributos/editar?i=<?= $id_atributo; ?>" style="margin-right:10px">
                                                    <img src="<?= DIR_IMG; ?>edit.png" />
                                                </a> 
                                                <a href="#" onClick="excluir_atributos('<?= $id_atributo ?>', '<?= $nome_atributo; ?>')" >
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
            </div> <!-- ./row -->
            <?php
        elseif ($_GET['id'] == 'editar' && isset($_GET['i'])):

            $atributo = $Atributos->get(_GetInt('i'));
            $id = $atributo['id'];
            $nome = $atributo['nome'];
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="update_atributo" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" value="<?= $nome; ?>" name="atributo" class="form-control" autofocus required  />
                        </div>
                        <input type="hidden" name="id" id="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/atributos';" />
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-6">

                    <p class="text-center text-red lead"><i class="fa fa-exclamation-triangle"></i> ATENÇÃO: <br /> A alteração desses valores terá efeito também nos Imóveis já cadastrados.</p>

                </div> 
            </div> <!-- ./row -->
            <?php
        endif;
        ?>

    </div> <!-- box-body -->
</div>