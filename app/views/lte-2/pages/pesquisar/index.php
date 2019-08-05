<div class="box box-default">
    <div class="box-body">

        <form id="pesquisa_avancada" action="javascript: submitForm()" method="post">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" id="categoria" onchange="this.form.submit()">
                            <option value=" " >Categoria</option>
                            <?php
                            // @table @option @value @selected @orderBy @Where
                            listaOption('config_categoria', 'categoria', 'value', null, 'ORDER BY categoria ASC', null);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" id="tipo" onchange="this.form.submit()">
                            <option value=" " >Tipo</option>
                            <?php
                            // @table @option @value @selected @orderBy @Where
                            listaOption('config_tipo', 'tipo', 'value', null, 'ORDER BY tipo ASC', null);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" id="stats" onchange="this.form.submit()">
                            <option value=" " >Status</option>
                            <?php
                            // @table @option @value @selected @orderBy @Where
                            listaOption('config_stats', 'stats', 'value', null, 'ORDER BY stats ASC', null);
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" id="zona" onchange="this.form.submit()">
                            <option value=" " >Zona</option>
                            <?php
                            // @table @option @value @selected @orderBy @Where
                            listaOption('config_zonas', 'zona', 'value', null, 'ORDER BY zona ASC', null);
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input class="form-control" type="text" id="ref" placeholder="Referência" onchange="this.form.submit()" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="form-control" type="text" id="bairro" placeholder="Bairro" onchange="this.form.submit()" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="form-control" type="text" id="condominio" placeholder="Condomínio/Edifício" onchange="this.form.submit()" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" id="preco" class="form-control valor text-olive" onchange="this.form.submit()" value="0,00">
                         
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                         <input type="text" id="preco2" class="form-control valor text-olive" onchange="this.form.submit()" value="5.000.000,00">
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>

<div class="loading center-block text-center" style="width:300px; height: 50px; display: none;">    
    <h1 style="font-size:60px"><i class="fa fa-spinner fa-spin"></i></h1>
    <h4>Carregando...</h4>
</div> <!-- ./progress bar -->

<div id="resultadoBusca"></div>