<?php
$Usuarios = new App\Models\Config\Usuarios_DAO();
?>
<form id="insert_usuario" action="" method="post">
    <div class="box-body">
        <div class="row"> 

            <div class="col-md-4">

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" autofocus required />
                </div>
                <div class="form-group">
                    <label>Login</label>
                    <input type="text" class="form-control" name="login" autofocus required  />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required />
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control" required>
                        <option value="padrao">Padrão</option>
                        <option value="administrador">Adminstrador</option>
                        <option value="gerente">Gerente</option>
                        <option value="corretor">Corretor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" name="senha1" required  />
                </div>
                <div class="form-group">
                    <label>Confirme a Senha</label>
                    <input type="password" class="form-control" name="senha2" required  />
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <input type="submit" class="btn btn-flat bg-olive" value="Cadastrar" />
        <input type="button" class="btn btn-flat bg-red" value="Cancelar" onClick="window.location.href = URL_ROOT + 'configuracoes/usuarios/';" />
    </div>
</form>
