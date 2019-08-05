<h3>v2.1.5 <small>07/11/2016</small></h3>
<ul>
    <li>Correção de Bug:</li>
    <ul>
        <li>Alguns campos de <strong>obs</strong> não aceitavam textos longos</li>
    </ul>
    <li>Adicionado opções no campo Interesse em <span class="text-green">Atendimento</span></li>
    <ul>
        <li>Avaliação</li>
        <li>Consultoria</li>
        <li>Despachante</li>
    </ul>

    
</ul>

<h3>v2.1.4 <small>16/05/2016</small></h3>
<ul>
    <li>Correção de Bug:</li>
    <ul>
        <li>Campos <strong>obs</strong> em Visitas não aceitava caracteres especiais</li>
    </ul>
    <li>Adicionado opção em <strong>status</strong> de Visitas/Serviços:</li>
    <ul>
        <li>Ausente</li>
        <li>Remarcar</li>
    </ul>
    
</ul>

<h3>v2.1.3 <small>09/05/2016</small></h3>
<ul>
    <li>Adicionado página de detalhes de Clientes.</li>
    
</ul>

<h3>v2.1.2 <small>06/05/2016</small></h3>
<ul>
    <li>Correção de bug:</li>
    <ul>
        <li>Editar Fiador com erros</li>
    </ul>
</ul>

<h3>v2.1.1 <small>03/05/2016</small></h3>
<ul>
    <li>Correção de bug:</li>
    <ul>
        <li>#Ref em Editar imóvel estava obrigatório</li>
        <li>Código do imóvel não aparecia em Editar Locatário > aba Imóvel</li>
    </ul>
</ul>


<h3>v2.1.0 <small>03/05/2016</small></h3>
<ul>
    <li>Arquitetura de Imóvel agora é baseada em <span class="text-green">Código</span></li>
    <ul>
        <li><mark>#Ref</mark> não é mais obrigatório e único</li>
        <li><mark>Código</mark> é obrigatório e único</li>
    </ul>
    <li>Campo <mark>Rua</mark> em Cadastro de Imóvel não é mais obrigatório</li>
</ul>

<h3>v2.0.3 <small>02/05/2016</small></h3>
<ul>
    <li>Opção adicionada em Proprietários e Locatários:</li>
    <ul>
        <li><mark>Declarante</mark>: Sim ou Não</li>
    </ul>
    <li>Em <a href="<?= URL_ROOT; ?>imovel/lista">Lista de Imóveis</a> não aparecerá imóveis Locados.</li>
</ul>

<h3>v2.0.2 <small>27/04/2016</small></h3>
<ul>
    <li>Correção de bug:</li>
    <ul>
        <li>Opção excluir usuário não estava funcionando</li>
        <li>Quando imóvel for desabilitado na página de Editar, não estava renomeando a pasta de imagens</li>
    </ul>
    <li>Opção <mark>RG</mark> agora pode receber 20 caracteres</li>
    <li>Campos agora podem receber <mark>/</mark></li>
    <li>Função <strong>Desabilitar</strong> (incluir 'D' após Ref) agora está inclusa automaticamente ao Editar o imóvel</li>
    <li>Opções adicionadas em Proprietários, Locatários e Fiadores:</li>
    <ul>
        <li>Representante</li>
        <li>Representante Contato</li>
        <li>Representante Email</li>
        <li>Complemento</li>
        <li>Status</li>
    </ul>
    <li>Opções adicionadas para Estado Civil:</li>
    <ul>
        <li>Divorciado(a)/Separado(a)</li>
        <li>Viúvo(a)</li>
    </ul>
</ul>

<h3>v2.0.1 <small>22/04/2016</small></h3>
<ul>
    <li>Correção de bug:</li>
    <ul>
        <li>Número de notificações aparecia incorretamente</li>
        <li>Checagem de #Ref no cadastro de imóvel estava com erro</li>
        <li>Lista de Proprietários e Locatários na modal <mark>Mais Detalhes</mark> (página do imóvel) estava com erro</li>
    </ul>
    <li>Colunas de Logs do Sistema incluidas <span class="text-olive">+ Data, Hora</span></li>
</ul>
<!--
<h3>v2.1.0</h3>
<ul>
    <li>Inserido opção <mark>código</mark> em imóveis. Tabela <mark>imovel</mark>, <strong>Not Null</strong>, <strong>Unique</strong></li>
    <li>Opção <mark>Ref</mark> em imóveis agora é <strong>Null</strong> e <strong>Not Unique</strong></li>
    <li>Arquitetura de Imóvel passa ser baseada em <mark>Código</mark> e não <mark>Ref</mark></li>
</ul>
-->
<h3>v2.0.0 <small>19/04/2016</small></h3>
<ul>
    <li>Layout totalmente modificado, baseado no template <a href="https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html" target="_blank">AdminLTE 2.1</a></li>
    <li>Componente <a href="https://github.com/FortAwesome/Font-Awesome" target="_blank">Font Awesome</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="https://datatables.net/examples/styling/bootstrap.html" target="_blank">DataTables</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="http://fronteed.com/iCheck/" target="_blank">iCheck</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="http://bootstrap-datepicker.readthedocs.org/" target="_blank">Date Picker</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="http://mjolnic.com/bootstrap-colorpicker/" target="_blank">Bootstrap Color Picker</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="https://github.com/ehpc/bootstrap-waitingfor" target="_blank">WaitingFor</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="https://github.com/RobinHerbots/jquery.inputmask/" target="_blank">Input Mask</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="https://viacep.com.br/" target="_blank">Via CEP</a> <span class="text-olive">+ Adicionado</span></li>
    <li>Plugin <a href="https://github.com/caxap/jquery-safeform" target="_blank">SafeForm</a> <span class="text-red">- Removido</span></li>
    <li>Plugin <a href="http://colpick/plugin/" target="_blank">ColPick</a> <span class="text-red">- Removido</span></li>
    <li>Plugin <a href="http://glad.github.com/glDatePicker/" target="_blank">gbDatePicker</a> <span class="text-red">- Removido</span></li>
    <li>Plugin <a href="http://digitalbush.com/projects/masked-input-plugin" target="_blank">MasketInput</a> <span class="text-red">- Removido</span></li>
    <li>Plugin CEP <span class="text-red">- Removido</span></li>
    <li>Correção de bugs</li>
</ul>