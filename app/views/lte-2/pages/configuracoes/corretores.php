<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Corretores = new Config\Corretores_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Corretores</span>
    </div>
    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">

                <div class="col-md-4">
                    <form id="insert_corretor" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="corretor" autofocus required  />
                        </div>

                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />

                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <?php
                    $result = $Corretores->getList();
                    ?> 
                    <p class="text-center loading"></p>
                    <table class="table table-hover table-striped table-bordered">  
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhum corretor cadastrado.";
                            else:
                                foreach ($result as $corretor):
                                    $nome_corretor = $corretor['corretor'];
                                    $id_corretor = $corretor['id'];
                                    ?>
                                    <tr id="<?= $id_corretor; ?>">
                                        <td>
                                            <?= mb_ucwords($nome_corretor); ?>
                                            
                                        </td>
                                        <td class="text-right">
                                            <a id="<?= $id_corretor; ?>" href="<?= URL_ROOT; ?>configuracoes/corretores/editar?i=<?= $id_corretor; ?>" style="margin-right:15px">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a> 
                                            <a  href="#" onClick="excluir_corretores('<?= $id_corretor ?>', '<?= $nome_corretor; ?>')">
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

            $corretores = $Corretores->get(_GetInt('i'));
            $nome = $corretores['corretor'];
            $id = $corretores['id'];
            ?>
            <div class="row">
                <div class="col-md-4">
                    <form id="update_corretor" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" value="<?= mb_ucwords($nome); ?>" class="form-control" name="corretor" autofocus required  />
                        </div>

                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/corretores';" />

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