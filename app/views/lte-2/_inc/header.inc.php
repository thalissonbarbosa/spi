<?php
$Alertas = new \Lib\Classes\Messages();
$Home = new \App\Models\Home();
$Avisos = $Home->avisos(2);
?>
<!-- Logo -->
<a href="<?= URL_ROOT; ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>C</b>G</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="<?= DIR_IMG; ?>logo-190x40.fw.png" /></span>
</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    
    <!-- 
    <form action="" method="get" id="s" class="pull-left" style="margin:7px 0 0 15px; width:30%">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Procurar imóvel...">
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>-->
    
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

            <!-- Iniciar Atendimento -->
            <button type="button" class="btn btn-warning btn-flat pull-left" data-toggle="modal" data-target="#modal-atendimento" style="margin-top:7px;">Iniciar Atendimento</button>

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="label label-warning"><?= $Alertas->alertas(); ?></span>
                </a>
                                
                <ul class="dropdown-menu">
                    <li class="header">Você tem <?= $Alertas->alertas(); ?> notificações</li>
                    <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                            <?php
                            $visitas = $Avisos['visita'];
                            foreach ($visitas as $visita):
                                $dataVisita = $visita['dataVisita'];
                                if ($dataVisita == date("Y-m-d")) {
                                    $hoje = true;
                                }
                                $date = explode("-", $dataVisita);
                                $dataVisita = $date[2] . "/" . $date[1] . "/" . $date[0];
                                $hora = substr($visita['hora'], 0, 5);
                                ?>
                                <li>
                                    <a>
                                        <i class="fa fa-calendar text-orange"></i> 
                                        <strong>Visita</strong> no imóvel <?= $visita['codigo_imovel']; ?>, Dia <?= $dataVisita ?> às <?= $hora ?>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                            $servicos = $Avisos['servico'];
                            foreach ($servicos as $servico):
                                $dataServico = $servico['dataServico'];
                                if ($dataServico == date("Y-m-d")) {
                                    $hoje = true;
                                }
                                $date = explode("-", $dataServico);
                                $dataServico = $date[2] . "/" . $date[1] . "/" . $date[0];
                                $hora = substr($servico['hora'], 0, 5);
                                ?>
                                <li>
                                    <a>
                                        <i class="fa fa-calendar text-orange"></i> 
                                        <strong>Serviço</strong> no imóvel <?= $servico['codigo_imovel']; ?>, Dia <?= $dataServico ?> às <?= $hora ?>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                            ?>

                            <!-- end notification -->
                        </ul>
                    </li>
                    <li class="footer"><a href="<?= URL_ROOT; ?>avisos">Ver tudo</a></li>
                </ul>
            </li>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs"><?= $_SESSION['user']['nome']; ?></span> <i class="fa fa-cog"></i>
                </a>
                <ul class="dropdown-menu">

                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <a href="<?= URL_ROOT; ?>configuracoes">Configurações</a>
                            </div>
                            <div class="col-xs-4 text-center">
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Suporte</a>
                            </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?= URL_ROOT; ?>usuario" class="btn btn-default btn-flat">Perfil</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= URL_ROOT; ?>usuario/logout" class="btn btn-default btn-flat">Sair</a>
                        </div>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>