<script>
    $(function ($) {
        $(".buscaProprietario").submit(function (ev) {
            ev.preventDefault();

            var busca = $("#buscaProprietario").val();

            var local = URL_ROOT + "clientes/searchGetProprietario";

            $(".progress").show();
            $.post(local, {busca: busca}, function (resposta) {

                $(".progress").hide();

                if (resposta != false) {

                    $("#resultBuscaProprietario").html(resposta);

                } else {
                    $("#resultBuscaProprietario").html(resposta);
                }
            });

        });
    });
</script>

<div class="modal fade" id="modal-add-proprietarios" tabindex="-1" role="dialog" aria-labelledby="modal-add-proprietarios">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Adicionar Proprietário</h4>

            </div>

            <div class="modal-body">

                <form class="buscaProprietario" action="" method="post">

                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control text-center" name="busca" id="buscaProprietario" autofocus placeholder="Pesquisar Proprietário (Nome, CPF, RG)" /> 

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-flat bg-olive" ><i class="fa fa-search"></i></button>
                        </span>
                    </div>

                </form>

                <div id="resultBuscaProprietario" style=" margin-top:30px; "></div>

                <div class="progress active no-background center-block text-center" style="width:300px; height: 50px; display: none;">
                    <h4 class="text-muted">Carregando...</h4>

                    <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar">
                    </div>
                </div> <!-- ./progress bar -->

            </div> <!-- ./modal-body -->
        </div>
    </div>

</div>