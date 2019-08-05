<div class="modal fade" id="modal-add-recursos" tabindex="-1" role="dialog" aria-labelledby="modal-add-recursos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Recursos</h4>
            </div> <!-- ./modal-header -->

            <form id="update_recursos" action="" method="post">
                <div class="modal-body">
                    <div class="messages_modal"></div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                $Recursos = new \App\Models\Config\Recursos_DAO();
                                $Imovel = new \App\Models\Imovel\Recursos_DAO();

                                // Lista de Todos os recursos
                                $recursos_all = $Recursos->getList();
                                // Lista de Todos os recursos do Imóvel
                                $recursos_cad = $Imovel->getListFrom(_GetString('id'));

                                // Criando o array para colocar os recursos do imóvel
                                $idRecursoImovel = array();
                                
                                // Checked Default
                                $checked = '';
                                
                                // Colocando o ID dos recursos cadastrados do imóvel no array criado
                                $i = 0;
                                foreach ($recursos_cad as $recurso):
                                    $idRecursoImovel[$i] = $recurso['id'];
                                    $i += 1;
                                endforeach;

                                // Percorrendo todos os recursos cadastrados
                                $contador = 0;
                                foreach ($recursos_all as $recurso):

                                    $idRecurso = $recurso['id'];
                                    $recurso = $recurso['nome'];

                                    for ($i = 0; $i < count($idRecursoImovel); $i++):
                                        // Verificando se o recurso está selecionado nesse imóvel
                                        if ($idRecurso == $idRecursoImovel[$i]) {
                                            $checked = 'checked="true"';
                                            break;
                                        } else {
                                            $checked = '';
                                        }
                                    endfor;

                                    // Verificando quantidade já mostrada para fazer quebra
                                    if ($contador > 19): // -1
                                        ?>
                                    </div> <!-- ./col-md-4 -->
                                    <div class="col-md-4">
                                        <?php
                                        $contador = 1;
                                    endif;
                                    ?>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="recursos[]" id="<?= "box" . $contador; ?>" value="<?= $idRecurso; ?>" <?= $checked; ?> />
                                            <?= mb_ucwords($recurso); ?>
                                        </label>
                                    </div>
                                    <?php
                                    $contador += 1;
                                endforeach;
                                ?>
                            </div> <!-- col-md-4 -->
                        </div> <!-- ./row -->

                    </div> <!-- ./form-group -->
                </div> <!-- ./modal-body -->


                <div class="modal-footer">

                    <input type="hidden" id="codigo" value="<?= _GetString('id'); ?>" />
                    <input type="submit" class="btn btn-flat bg-olive" value="Salvar" />
                    <input type="button" class="btn btn-flat bg-red" data-dismiss="modal" value="Cancelar" />

                    <div class="loading"></div>
                </div> <!-- ./modal-footer -->

            </form>

        </div> <!-- ./modal-content -->
    </div> <!-- ./modal-dialog -->
</div> <!-- ./modal -->