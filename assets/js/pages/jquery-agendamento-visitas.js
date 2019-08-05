function setRefImovel(ref) {
    $('.ref').attr('value', ref);
}
// Cadastrar  Visita
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#cad_visita").submit(function (ev) {

        ev.preventDefault();

        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'agendamento/insertVisita', $(this).serialize(), function (resposta) {

            // Exibe a div status
            $(".overlay").remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Visita Agendada!");
                window.location.href = URL_ROOT + "agendamento/visitas";
            }
        });
    });
});
// Editar Visita
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#edit_visita").submit(function (ev) {

        ev.preventDefault();

        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'agendamento/updateVisita', $(this).serialize(), function (resposta) {
            $(".overlay").remove();

            // Se a resposta é um erro
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Salvo com Sucesso!");
                window.location.href = URL_ROOT + "agendamento/visitas";
            }
        });

    });
});

/*
 * Excluir Visita
 */
function excluir_visita(idVisita) {

    if (confirm("Você tem certeza que deseja excluir esta visita?")) {

        var id = idVisita;

        $.post(URL_ROOT + 'agendamento/deleteVisita', {
            visita_id: id
        }, function (resposta) {
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $("#" + id).fadeOut(300, function () {
                    $(this).remove();
                });
                //window.location.href = URL_ROOT + "agendamento/visitas";
            }
        });
    }
}

/*
 * Buscar  Visita
 */
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $(".buscaVisitas").submit(function () {

        var busca = $("#buscaVisita").val();
        var img = "<img src='" + DIR_IMG + "loader.gif' align='center' />";

        // Exibe mensagem de carregamento
        $('.loadingSearch').show();
        $(".loadingSearch").html(img);

        $.post(URL_ROOT + "agendamento/searchVisita", {busca: busca}, function (resposta) {

            $(".loadingSearch").hide();

            if (resposta == false) {
                $("#lista").html(resposta);
            } else {
                $("#lista").html(resposta);

            }
        });
    });
});