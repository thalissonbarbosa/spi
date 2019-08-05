<?php

use Lib\Classes as Classes;

$user = $Usuarios->get(_GetInt('i'));
$id = $user['id'];
$nome = mb_ucwords($user['nome']);
$login = mb_tolower($user['login']);
$email = mb_tolower($user['email']);
$tipo = mb_tolower($user['tipo']);
?>

<form id="update_usuario" action="" method="post">
    <div class="box-body">
        <div class="row"> 
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" value="<?= $nome; ?>" class="form-control" name="nome" autofocus required />
                </div>
                <div class="form-group">
                    <label>Login</label>
                    <input type="text" value="<?= $login; ?>" class="form-control" name="login" autofocus required  />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="<?= $email; ?>" class="form-control" name="email" required />
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control" required>
                        <option value="administrador" <?= ($tipo == 'administrador') ? "selected" : "" ?>>Adminstrador</option>
                        <option value="gerente" <?= ($tipo == 'gerente') ? "selected" : "" ?>>Gerente</option>
                        <option value="padrao" <?= ($tipo == 'padrao') ? "selected" : "" ?>>Padrão</option>
                        <option value="corretor" <?= ($tipo == 'corretor') ? "selected" : "" ?>>Corretor</option>
                    </select>
                </div>
            </div> <!-- ./col-md-4 -->

            <div class="col-md-1"></div>

            <div class="col-md-6">
                <?php
                $Permissoes = new Classes\Permissoes();
                $user = $Permissoes->getUser($id);
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="iCheck" name="imovel_cad" <?= (permissao('imovel_cad', $id)) ? 'checked' : '' ?>  />
                                    Imóvel <i class="fa fa-angle-right"></i></i> Cadastrar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="imovel_edit" <?= (permissao('imovel_edit', $id)) ? 'checked="true"' : '' ?>  />
                                    Imóvel <i class="fa fa-angle-right"></i> Editar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="imovel_del" <?= (permissao('imovel_del', $id)) ? 'checked="true"' : '' ?>  />
                                    Imóvel <i class="fa fa-angle-right"></i> Excluir
                                </label>
                            </div>
                            <br />
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fiador_cad" <?= (permissao('fiador_cad', $id)) ? 'checked="true"' : '' ?>  />
                                    Fiador <i class="fa fa-angle-right"></i> Cadastrar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fiador_edit" <?= (permissao('fiador_edit', $id)) ? 'checked="true"' : '' ?>  />
                                    Fiador <i class="fa fa-angle-right"></i> Editar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fiador_del" <?= (permissao('fiador_del', $id)) ? 'checked="true"' : '' ?>  />
                                    Fiador <i class="fa fa-angle-right"></i> Excluir
                                </label>
                            </div>
                            <br />
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="locatario_cad" <?= (permissao('locatario_cad', $id)) ? 'checked="true"' : '' ?>  />
                                    Locatário <i class="fa fa-angle-right"></i> Cadastrar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="locatario_edit" <?= (permissao('locatario_edit', $id)) ? 'checked="true"' : '' ?>  />
                                    Locatário <i class="fa fa-angle-right"></i> Editar
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="locatario_del" <?= (permissao('locatario_del', $id)) ? 'checked="true"' : '' ?>  />
                                    Locatário <i class="fa fa-angle-right"></i> Excluir
                                </label>
                            </div>
                        </div>
                    </div> <!-- ./col-md-6 -->
                    
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="proprietario_cad" <?= (permissao('proprietario_cad', $id)) ? 'checked="true"' : '' ?>  />
                                Proprietário <i class="fa fa-angle-right"></i> Cadastrar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="proprietario_edit" <?= (permissao('proprietario_edit', $id)) ? 'checked="true"' : '' ?>  />
                                Proprietário <i class="fa fa-angle-right"></i> Editar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="proprietario_del" <?= (permissao('proprietario_del', $id)) ? 'checked="true"' : '' ?>  />
                                Proprietário <i class="fa fa-angle-right"></i> Excluir
                            </label>
                        </div>
                        <br />
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="visita_cad" <?= (permissao('visita_cad', $id)) ? 'checked="true"' : '' ?>  />
                                Visitas <i class="fa fa-angle-right"></i> Cadastrar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="visita_edit" <?= (permissao('visita_edit', $id)) ? 'checked="true"' : '' ?>  />
                                Visitas <i class="fa fa-angle-right"></i> Editar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="visita_del" <?= (permissao('visita_del', $id)) ? 'checked="true"' : '' ?>  />
                                Visitas <i class="fa fa-angle-right"></i> Excluir
                            </label>
                        </div>
                        <br />
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="servicos_cad" <?= (permissao('servicos_cad', $id)) ? 'checked="true"' : '' ?>  />
                                Serviços <i class="fa fa-angle-right"></i> Cadastrar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="servicos_edit" <?= (permissao('servicos_edit', $id)) ? 'checked="true"' : '' ?>  />
                                Serviços <i class="fa fa-angle-right"></i> Editar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="servicos_del" <?= (permissao('servicos_del', $id)) ? 'checked="true"' : '' ?>  />
                                Serviços <i class="fa fa-angle-right"></i> Excluir
                            </label>
                        </div>
                        <br />
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="atendimento_edit" <?= (permissao('atendimento_edit', $id)) ? 'checked="true"' : '' ?>  />
                                Atendimento <i class="fa fa-angle-right"></i> Editar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="atendimento_del" <?= (permissao('atendimento_del', $id)) ? 'checked="true"' : '' ?>  />
                                Atendimento <i class="fa fa-angle-right"></i> Excluir
                            </label>
                        </div>
                    </div><!-- ./col-md-6 -->
                </div>
            </div> <!-- ./col-md-6 -->

        </div>
    </div>
    <div class="box-footer">
        <input type="hidden" name="id" value="<?= $id; ?>" />
        <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/usuarios';" />
    </div>
</form>
