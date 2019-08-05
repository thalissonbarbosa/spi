<?php
$Usuario = new App\Models\Config\Usuarios_DAO();
$user = $Usuario->get($_SESSION['user']['id']);

$nome = mb_ucwords($user['nome']);
$login = mb_tolower($user['login']);
$email = mb_tolower($user['email']);
$id = $user['id'];
?>

<div class="box">
    <div class="box-header with-border">
        <span class="box-title"><i class="fa fa-user"></i> Perfil</span>
    </div>

    <form id="update_perfil" action="" method="post">  

        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="obrigatorio">Nome</label>
                        <input type="text" class="form-control" name="nome" autofocus required value="<?= $nome ?>" />
                    </div>
                    <div class="form-group">
                        <label class="obrigatorio">Login</label>
                        <input type="text" class="form-control" name="login" required value="<?= $login ?>" />
                    </div>
                    <div class="form-group">
                        <label class="obrigatorio">Email</label>
                        <input type="email" class="form-control" name="email" required value="<?= $email; ?>"  />
                    </div>
                    <div class="form-group">
                        <label class="obrigatorio">Senha Atual</label>
                        <input type="password" class="form-control" name="senha_atual" required />
                    </div>
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <input type="password" class="form-control" name="nova_senha" />
                    </div>
                    <div class="form-group">
                        <label>Confirme a senha</label>
                        <input type="password" class="form-control" name="nova_senha2" />
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <input type="hidden" name="id" value="<?= $id; ?>" />
            <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
            <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="history.back();" />
        </div>
    </form>
</div>