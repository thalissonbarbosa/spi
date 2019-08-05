<div class="box">
    <div class="box-header with-border">
        <span class="box-title"><i class="fa fa-gear"></i> Usuários</span>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <a href="<?= URL_ROOT; ?>usuario/">
                    <div class="info-box bg-purple">
                        <span class="info-box-icon"><i class="fa fa-user"></i></span>
                        <div class="info-box-content content-middle">
                            <h3>Editar Perfil</h3>
                        </div>
                    </div>
                </a>
            </div>
            <?php if ($_SESSION['user']['tipo'] == 'administrador') {
                ?>
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/usuarios/">
                        <div class="info-box bg-purple cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-users"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Usuários</h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php if (permissao('imovel_config')) {
    ?>
    <div class="box">
        <div class="box-header with-border">
            <span class="box-title"><i class="fa fa-gear"></i> Imóvel</span>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/atributos/">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-list"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Atributos</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/categorias/">
                        <div class="info-box bg-red cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-tags"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Categorias</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/corretores/">
                        <div class="info-box bg-red cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-users"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Corretores</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/recursos/">
                        <div class="info-box bg-red cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-th-large"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Recursos</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div> <!-- ./row -->

            <div class="row">
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/status/">
                        <div class="info-box bg-red cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Status</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/tipos/">
                        <div class="info-box bg-red cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-list"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Tipos</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div> <!-- ./row -->
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <span class="box-title"><i class="fa fa-gear"></i> Serviços</span>
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/prestadores/">
                        <div class="info-box bg-light-blue cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-users"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Prestadores</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= URL_ROOT; ?>configuracoes/servicos/">
                        <div class="info-box bg-light-blue cursor-pointer" >
                            <span class="info-box-icon"><i class="fa fa-file-text"></i></span>
                            <div class="info-box-content content-middle">
                                <h3>Serviços</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    