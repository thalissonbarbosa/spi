<div id="logo">

    <a href="<?= URL_ROOT; ?>"><img src=<?= DIR_IMG; ?>logoCabralGama.png /></a>
</div>

<form id="search" action="javascript:func()" method="post">
    <input type="text" name="busca" id="busca" onchange="this.form.submit()" placeholder="Pesquisar imóvel por referência, bairro, cep" /> <input type="image" src=<?= DIR_IMG; ?>icon-search.png name="envia" />
    <input type="hidden" name="paginaAtual" id="paginaAtual" value=<?= basename(getcwd()); ?> /> 
</form>

<div id="menu-topo">

    <div class="dropdown">
        <a class="conta icon-user" ><?= $_SESSION['user']['nome']; ?></a>
        <div class="submenu" style="display:none;">
            <ul class="raiz">
                <li style="margin-top:-10px"><a href=<?= URL_ROOT . "configuracoes/"; ?> >Configurações</a></li>
                <li><a href=<?= URL_ROOT . "suporte/"; ?> >Suporte</a></li>
                <li><a href=<?= URL_ROOT . "usuario/logout"; ?> >Sair</a></li>
            </ul>
        </div>
    </div>

    <?php
    $Alertas = new Lib\Classes\Messages();
    ?>
    <a href=<?= URL_ROOT . "avisos/"; ?> class="alerta" ><?= $Alertas->alertas(); ?></a> 


    <!-- BOX ATENDIMENTO -->         
    <a href="#atendimento" class="atendimento">Iniciar Atendimento</a>
    <div class="window" id="atendimento">

        <div class="titulo" style="text-align:center;">Iniciar Atendimento</div>

        <div id="message_at" style="margin-left:-10px"></div>
        
        <form id="cad_atendimento" class="formulario" method="post" action="javascript: func()" >
            <div class="cadastro-left" style="padding-right:50px ">
                <table class="cadastro">
                    <tr>
                        <td ><span class="obrigatorio"></span>Nome</td><td><input type="text" id="at_nome" required /></td>
                    </tr>
                    <tr> 
                        <td>E-mail:</td><td><input type="text" id="at_email" /></td>
                    </tr>
                    <tr>
                        <td>Telefone/Celular:</td><td><input type="text" id="at_tel" class="tel" /></td>
                    </tr>
                    <tr>
                        <td>Telefone Comercial:</td><td><input type="text" id="at_tel_comercial" class="tel" /></td>
                    </tr>
                    <tr>
                        <td>Como Conheceu:</td>
                        <td>  
                            <select id="at_conheceu" style="width: 190px;">
                                <option value="Site">Site</option><option value="Google">Google</option>
                                <option value="Indicação">Indicação</option><option value="Jornal">Jornal</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>Obs.</td><td><textarea id="at_obs" style="height: 50px; width: 185px"></textarea></td></tr>

                </table>
            </div>
            <div class="cadastro-left" style="margin-left:5px;">
                <table class="cadastro">
                    <tr>
                        <td>Tipo:</td>
                        <td>
                            <select id="at_tipo">
                                
                                <?php 
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_tipo', 'tipo', 'value', null, 'ORDER BY tipo ASC', null); 
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="obrigatorio"></span>Interesse:</td>
                        <td>
                            <select id="at_interesse" multiple style="height: 90px;" required>
                                <?php 
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_categoria', 'categoria', 'value', null, 'ORDER BY categoria ASC', null); 
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>De:</td><td><input type="text" id="valor_de" class="valor cadastroValor" value="0,00" /></td>
                    </tr>
                    <tr>
                        <td>Até:</td><td><input type="text" id="valor_ate" class="valor cadastroValor" value="200.000,00" /></td>
                    </tr>
                    <tr><td>Zona</td><td> 
                            <select id="at_zona" multiple style=" height: 70px">
                                <option value="Todas" selected="selected">Todas</option>
                                <?php
                                // @table @option @value @selected @orderBy @where
                                listaOption('config_zonas', 'zona', 'value', null, 'ORDER BY id ASC', null); 
                                ?>
                            </select>
                        </td></tr>

                    <input type="hidden" id="url" value="<?= URL_ROOT; ?>" />
                </table>
            </div>
            <div class="clear"></div>
            <table style="text-align: center; margin-left: 150px;">
                <tr>
                    <td><input type="submit" value="SALVAR" /></td>
                    <td><input type="button" value="CANCELAR" class="fechar" /></td>
                    <td><div class="at_loading" style="margin-top:30px"></div></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="mascara"></div>


</div>




