<script>

    $(function ($) {
        $(".buscaFiador").submit(function (ev) {
            ev.preventDefault();

            var busca = $("#buscaFiador").val();
            
            var local = URL_ROOT + "clientes/searchGetFiador";

            $(".progress").show();

            $.post(local, {busca: busca}, function (resposta) {

                $(".progress").hide();

                if (resposta != false) {

                    $("#resultBuscaFiador").html(resposta);

                } else {
                }
            });
        });
    });
</script>

<div class="modal fade" id="modal-add-fiador" tabindex="-1" role="dialog" aria-labelledby="modal-add-fiador">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Fiador</h4>

            </div>

            <div class="modal-body">

                <form class="buscaFiador" action="" method="post">

                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control text-center" name="busca" id="buscaFiador" autofocus placeholder="Pesquisar Fiador (Nome, CPF, RG)" /> 

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-flat bg-olive" ><i class="fa fa-search"></i></button>
                        </span>
                    </div>

                </form>

                <div id="resultBuscaFiador" style=" margin-top:30px; "></div>

                <div class="progress active no-background center-block text-center" style="width:300px; height: 50px; display: none;">
                    <h4 class="text-muted">Carregando...</h4>

                    <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar">
                    </div>
                </div> <!-- ./progress bar -->

            </div> <!-- ./modal-body -->
        </div>
    </div>

</div>