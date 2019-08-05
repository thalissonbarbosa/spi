<div id="menu-lateral">
    <div class="bem-vindo">Bem Vindo! <br /> 
        <?php
        getDataExtensa();
        ?>
    </div>

    <ul class="menu-lateral-lista">
        <a href=<?= URL_ROOT; ?> ><li <?= ($_GET['controller'] == "") ? "class='selected'" : ""; ?> ><img src=<?= DIR_IMG; ?>icon-dashboard.png />Início</li></a> 
        <a href=<?= URL_ROOT . "imovel/"; ?>>
            <li <?= ($_GET['controller'] == "imovel") ? "class='selected'" : ""; ?> >
                <img src=<?= DIR_IMG; ?>icon-imoveis.png />Imóveis
                <ul class="submenu-1">
                    <?php if (permissao('imovel_cad')) {
                        ?>
                        <a href="<?= URL_ROOT ?>imovel/cadastrar"><li>Cadastrar Imóvel</li></a>
                    <?php } ?>
                    <a href="<?= URL_ROOT ?>imovel/lista"><li>Lista de Imóveis</li></a>


                </ul> <!-- Fim submenu-1 -->
            </li>
        </a>

        <a href=<?= URL_ROOT . "clientes/"; ?>>
            <li <?= ($_GET['controller'] == "clientes") ? "class='selected'" : ""; ?> >
                <img src=<?= DIR_IMG; ?>icon-clientes.png />Clientes

                <ul class="submenu-1">
                    
                    <a href="<?= URL_ROOT ?>atendimento/"><li>Atendimentos</li></a>
                    <a href="<?= URL_ROOT ?>clientes/fiadores"><li>Fiadores</li></a>
                    <a href="<?= URL_ROOT ?>clientes/locatarios"><li>Locatários</li></a>
                    <a href="<?= URL_ROOT ?>clientes/proprietarios"><li>Proprietários</li></a>
                    
                </ul> <!-- Fim submenu-1 -->
            </li>
        </a>
        <a href=<?= URL_ROOT . "agendamento/"; ?>>
            <li <?= ($_GET['controller'] == "agendamento") ? "class='selected'" : ""; ?> >
                <img src=<?= DIR_IMG; ?>icon-calendar.png />Agendamento
                <ul class="submenu-1">              

                    <a href="<?= URL_ROOT ?>agendamento/servicos"><li>Serviços</li></a>
                    <a href="<?= URL_ROOT ?>agendamento/visitas"><li>Visitas</li></a>
                   

                </ul> <!-- Fim submenu-1 -->
            </li>
        </a>
        <a href=<?= URL_ROOT . "pesquisar/"; ?> ><li <?= ($_GET['controller'] == "pesquisar") ? "class='selected'" : ""; ?> >
                <img src=<?= DIR_IMG; ?>search.png />Pesquisar</li>
        </a> 

    </ul>

</div>