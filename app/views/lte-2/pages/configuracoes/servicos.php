<?php

Use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Servicos = new Config\Servicos_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Tipo de Serviços</span>
    </div>
    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="insert_servicos_tipo" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="servico" autofocus required  />
                        </div>

                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />

                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <?php
                    $result = $Servicos->getList();
                    ?> 
                    <table class="table table-hover table-striped">    
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhum tipo cadastrado.";
                            else:
                                foreach ($result as $servico):
                                    $nome = $servico['tipo'];
                                    $id = $servico['id'];
                                    ?>
                                    <tr id="<?= $id; ?>">
                                        <td><?= mb_ucwords($nome); ?> </td>
                                        <td class="text-right">
                                            <a href="<?= URL_ROOT; ?>configuracoes/servicos/editar?i=<?= $id; ?>" style="margin-right:10px;">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a> 
                                            <a href="#" onClick="javascript: excluir_servicos_tipo('<?= $id ?>', '<?= $nome; ?>')">
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

            $servicos = $Servicos->get(_GetInt('i'));
            $id = $servicos['id'];
            $nome = mb_ucwords($servicos['tipo']);
            ?>

            <div class="row">

                <div class="col-md-4">
                    <form id="update_servicos_tipo" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="<?= $nome; ?>" name="servico" autofocus required  />
                        </div>
                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/servicos';" />

                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-6 text-center text-red">
                    <h4><i class="fa fa-exclamation-triangle"></i> ATENÇÃO: <br /> A alteração desses valores terá efeito também nos Serviços já cadastrados.</h4>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>