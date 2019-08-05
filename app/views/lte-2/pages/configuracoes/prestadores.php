<?php

use App\Models\Config as Config;
use Lib\Classes as Classes;

if (!permissao('imovel_config')):
    Classes\Messages::setMsg('Você não possui permissão para acessar este conteúdo.', 'error');
    Classes\Messages::getMsg();
    exit();
endif;

$Prestadores = new Config\Prestadores_DAO();
$TipoServico = new Config\Servicos_DAO();
?>
<div class="box">
    <div class="box-header">
        <span class="box-title"><i class="fa fa-gear"></i> Prestadores</span>
    </div>
    <div class="box-body">
        <?php
        if ($_GET['id'] != 'editar'):
            ?>
            <div class="row">

                <div class="col-md-4">
                    <form id="insert_prestador" class="formulario" action="javascript:func()" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" autofocus required  />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control tel" required  />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone2" class="form-control tel" />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone3" class="form-control tel" />
                        </div>
                        <div class="form-group">
                            <label>Tipo de Serviço</label>
                            <select class="form-control" name="tipoServico">
                                <?php
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_tipo_servicos', 'tipo', null, null, 'ORDER BY tipo ASC', null);
                                ?>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/';" />

                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-5">
                    <?php
                    $result = $Prestadores->getList();
                    ?> 
                    <table class="table table-hover table-striped">   
                        <tbody>
                            <?php
                            if (count($result) == 0):
                                echo "Nenhum prestador cadastrado.";
                            else:
                                foreach ($result as $prestador):
                                    $nome = mb_ucwords($prestador['nome']);
                                    $telefone = $prestador['telefone'];
                                    $telefone2 = $prestador['telefone2'];
                                    $telefone3 = $prestador['telefone3'];
                                    $id_servico = $prestador['config_tipo_servicos_id'];
                                    $id = $prestador['id'];

                                    $result = $TipoServico->get($id_servico);
                                    $nome_servico = $result['tipo'];
                                    ?>
                                    <tr id="<?= $id; ?>">
                                        <td>
                                            <?= $nome . " - <span class='text-orange'>" . mb_ucwords($nome_servico) . "</span> <span class='text-light-blue' style='float: right'> {$telefone} / {$telefone2} / {$telefone3}  </span>"; ?> 
                                        </td>
                                        <td class="text-right">
                                            <a id="<?= $id; ?>" href="<?= URL_ROOT; ?>configuracoes/prestadores/editar?i=<?= $id; ?>" style="margin-right:10px">
                                                <img src="<?= DIR_IMG; ?>edit.png" />
                                            </a>
                                            <a href="#" onClick="excluir_prestador('<?= $id; ?>', '<?= $nome; ?>')" >
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

            $prestadores = $Prestadores->get(_GetInt('i'));
            $id = $prestadores['id'];
            $nome = mb_ucwords($prestadores['nome']);
            $telefone = $prestadores['telefone'];
            $telefone2 = $prestadores['telefone2'];
            $telefone3 = $prestadores['telefone3'];
            $tipoServico = $prestadores['config_tipo_servicos_id'];
            $nome_servico = $TipoServico->get($tipoServico);
            $nome_servico = $nome_servico['tipo'];
            ?>

            <div class="row">

                <div class="col-md-4">
                    <form id="update_prestador" action="" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" value="<?= $nome; ?>" name="nome" class="form-control" autofocus required  />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" value="<?= $telefone ?>" name="telefone" class="form-control tel" required  />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" value="<?= $telefone2 ?>" name="telefone2" class="form-control tel" />
                        </div>
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" value="<?= $telefone3 ?>" name="telefone3" class="form-control tel" />
                        </div>
                        <div class="form-group">
                            <label>Tipo de Serviço</label>
                            <select class="form-control" name="tipoServico">
                                <?php
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_tipo_servicos', 'tipo', null, $nome_servico, 'ORDER BY tipo ASC', null);
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/prestadores';" />

                    </form>
                </div>

                <div class="col-md-1"></div>


                <div class="col-md-6 text-center text-red">
                    <h4>
                        <i class="fa fa-exclamation-triangle"></i> ATENÇÃO: 
                        <br /> A alteração desses valores terá efeito também nos Serviços já cadastrados.</h4>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>