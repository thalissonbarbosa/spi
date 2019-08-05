<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Status = new Config\Status_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Status</span>
    </div>
    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="insert_status" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="status" class="form-control" autofocus required  />
                        </div>
                        <div class="form-group">
                            <label>Cor</label>
                            <input type="text" class="form-control colorPicker" name="cor" />
                        </div>
                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />

                    </form>
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <?php
                    $result = $Status->getList();
                    ?> 
                    <table class="table table-hover table-striped">    
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhum status cadastrado.";
                            else:
                                foreach ($result as $status):
                                    $nome_status = $status['stats'];
                                    $id_status = $status['id'];
                                    $cor_status = $status['cor'];
                                    ?>

                                    <tr  id="<?= $id_status ?>">
                                        <td><?= mb_ucwords($nome_status); ?> <div class="label pull-right" style="background:#<?= $cor_status; ?>; color:#FFF;">Cor #<?= $cor_status ?></div> </td>
                                        <td class="text-right">
                                            <a id="<?= $id_status; ?>" href="<?= URL_ROOT; ?>configuracoes/status/editar?i=<?= $id_status; ?>" style="margin-right:10px;">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a> 
                                            <a href="#" onClick="excluir_status('<?= $id_status ?>', '<?= $nome_status; ?>')">
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

            $status = $Status->get(_GetInt('i'));
            $nome = mb_ucwords($status['stats']);
            $id = $status['id'];
            $cor = $status['cor'];
            ?>

            <div class="row">
                <div class="col-md-4">
                    <form id="update_status" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" value="<?= mb_ucwords($nome); ?>" name="status" class="form-control" autofocus required  />
                        </div>
                        <div class="form-group">
                            <label>Cor</label>
                            <input type="text" value="<?= '#' . $cor; ?>" class="form-control colorPicker" name="cor" />
                        </div>
                        <input type="hidden" value="<?= $id; ?>" name="id" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/status';" />

                    </form>
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-6 text-center text-red">
                    <h4><i class="fa fa-exclamation-triangle"></i> ATENÇÃO: <br /> A alteração desses valores terá efeito também nos Imóveis já cadastrados.</h4>
                </div>
            </div>

            <?php
        endif;
        ?>
    </div>
</div>