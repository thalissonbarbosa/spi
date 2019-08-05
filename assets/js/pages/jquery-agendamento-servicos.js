function setRefImovel(ref) {
    $('.ref').attr('value', ref);
}

/*
 * Cadastrar Serviço
 */
$(function ($) {

    $("#cad_servicos").submit(function (ev) {

        ev.preventDefault();

        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'agendamento/insertServico', $(this).serialize(), function (resposta) {

            $(".overlay").remove();
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Serviço Agendado!");
                window.location.href = URL_ROOT + "agendamento/servicos";
            }
        });
    });
});

/*
 * Editar Serviço
 */
$(function ($) {
    $("#edit_servicos").submit(function (ev) {

        ev.preventDefault();

        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'agendamento/updateServico', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Serviço alterado com sucesso!");
                window.location.href = URL_ROOT + "agendamento/servicos";
            }
        });
    });
});

/*
 * Excluir Serviço
 */
function excluir_servicos(idServico) {

    if (confirm("Você tem certeza que deseja excluir este Serviço?")) {

        var id = idServico;

        $.post(URL_ROOT + 'agendamento/deleteServico', {
            servico_id: id
        }, function (resposta) {
            if (resposta != false) {
                $("#message").html(resposta);
            } else {
                $("#" + id).fadeOut(300, function () {
                    $(this).remove();
                });
                //window.location.href = "./servicos";
            }
        });
    }
}

/*
 * Buscar Serviço
 */
$(function ($) {
    $(".buscaServicos").submit(function () {

        var busca = $("#buscaServicos").val();
        var img = "<img src='" + DIR_IMG + "loader.gif' align='center' />";

        // Exibe mensagem de carregamento
        $('.loadingSearch').show();
        $(".loadingSearch").html(img);

        $.post(URL_ROOT + 'agendamento/searchServico', {busca: busca}, function (resposta) {

            $("#resultadoBusca").show();
            $(".loadingSearch").hide();
            // Se a resposta é um erro
            if (resposta != false) {
                $(".tbody").html(resposta);
            } else {
                $(".tbody").html(resposta);

            }
        });
    });
});
