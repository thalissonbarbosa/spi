<div class="modal fade" id="modal-add-atributos" tabindex="-1" role="dialog" aria-labelledby="modal-add-atributos">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atributos</h4>
            </div> <!-- ./modal-header -->

            <form id="add-atributos" action="" method="post">

                <div class="modal-body">
                    <div class="messages_modal"></div>
                    
                    <div class="form-group">
                        <label>Atributo</label>
                        <select class="form-control" id="atributo">
                            <?php
                            // @table @option @value @selected @orderBy @Where
                            listaOption('config_atributos', 'nome', null, null, 'ORDER BY nome ASC', null);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" class="form-control" id="qtd" value="1" />
                    </div>
                </div> <!-- ./modal-body -->

                <div class="modal-footer text-center">
                    <input type="hidden" id="codigo" value="<?= _GetString('id'); ?>" />
                    <input type="submit" class="btn btn-flat bg-olive" value="Adicionar" />
                    <input type="button" class="btn btn-flat bg-red" data-dismiss="modal" value="Cancelar" />

                    <div class="loading"></div>
                </div> <!-- ./modal-footer -->

            </form>   

        </div> <!-- ./modal-content -->

    </div> <!-- ./modal-dialog -->

</div>