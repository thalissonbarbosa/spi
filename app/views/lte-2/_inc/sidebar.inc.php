<section class="sidebar">

    <!-- Sidebar user panel  -->
    <div class="user-panel text-center" style="color: #FFF;">
        <p>Bem Vindo!</p>
        <?= getDataExtensa() ?>
    </div>

    <!-- search form -->
    <form action="" method="get" id="s" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Procurar imóvel...">
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header"></li>
        <!-- Optionally, you can add icons to the links -->
        <li <?= (empty($_GET['controller'])) ? 'class="active"' : ''; ?>>
            <a href="<?= URL_ROOT; ?>"><i class="fa fa-tachometer"></i> <span>Início</span>
            </a>
        </li>

        <li class="treeview <?= ($_GET['controller'] == 'imovel') ? 'active' : ''; ?>">
            <a href="#">
                <i class="glyphicon glyphicon-home"></i> <span>Imóvel</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?= ($_GET['action'] == 'cadastrar') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>imovel/cadastrar">
                        <i class="fa fa-caret-right"></i>Cadastrar
                    </a>
                </li>
                <li <?= ($_GET['action'] == 'lista') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>imovel/lista">
                        <i class="fa fa-caret-right"></i>Lista
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview <?= ($_GET['controller'] == 'clientes' || $_GET['controller'] == 'atendimento') ? 'active' : ''; ?>">
            <a href="#">
                <i class="glyphicon glyphicon-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?= ($_GET['controller'] == 'atendimento') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>atendimento">
                        <i class="fa fa-caret-right"></i>Atendimentos
                    </a>
                </li>
                <li <?= ($_GET['action'] == 'locatarios') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>clientes/locatarios">
                        <i class="fa fa-caret-right"></i>Locatários
                    </a>
                </li>
                <li <?= ($_GET['action'] == 'fiadores') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>clientes/fiadores">
                        <i class="fa fa-caret-right"></i>Fiadores
                    </a>
                </li>
                <li <?= ($_GET['action'] == 'proprietarios') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>clientes/proprietarios">
                        <i class="fa fa-caret-right"></i>Proprietários
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview <?= ($_GET['controller'] == 'agendamento') ? 'active' : ''; ?>">
            <a href="#">
                <i class="fa fa-calendar"></i> <span>Agendamento</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li <?= ($_GET['action'] == 'servicos') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>agendamento/servicos">
                        <i class="fa fa-caret-right"></i>Serviços
                    </a>
                </li>
                <li <?= ($_GET['action'] == 'visitas') ? 'class="active"' : ''; ?>>
                    <a href="<?= URL_ROOT; ?>agendamento/visitas">
                        <i class="fa fa-caret-right"></i>Visitas
                    </a>
                </li>
            </ul>
        </li>
        <li <?= ($_GET['controller'] == 'pesquisar') ? 'class="active"' : ''; ?>>
            <a href="<?= URL_ROOT; ?>pesquisar">
                <i class="fa fa-search"></i> <span>Pesquisar</span>
            </a>
        </li>
    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->