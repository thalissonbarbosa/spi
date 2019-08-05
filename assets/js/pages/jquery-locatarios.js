
// ================= CADASTRAR LOCATARIO =================
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#insert_locatario").submit(function (ev) {

        ev.preventDefault();

        // Exibe mensagem de carregamento
        $('.alert').remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'clientes/insertLocatario', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            else {
                alert("Cadastrado com Sucesso!");
                window.location.href = URL_ROOT + "clientes/locatarios";
            }
        });
    });
});

// ================= EDITAR CLIENTE =================
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#update_locatario").submit(function (ev) {
        
        ev.preventDefault();
        
        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        
        $.post(URL_ROOT + 'clientes/updateLocatario', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            else {
                alert("Editado com Sucesso!");
                window.location.href = URL_ROOT + "clientes/locatarios";
            }
        });
    });
});

// ================= BUSCA LOCATARIO =================

$(function ($) {
    $(".buscaLocatarios").submit(function () {

        var busca = $("#buscaLocatario").val();

        var local = "clientes/searchLocatario";
        var img = "<img src='" + DIR_IMG + "loader.gif' align='center' />";

        $('.loadingSearch').show();
        $(".loadingSearch").html(img);

        $.post(URL_ROOT + local, {busca: busca}, function (resposta) {

            $(".loadingSearch").hide();

            if (resposta == false) {
                $('.tbody').html(resposta);
            }
            else {
                $('.tbody').html(resposta);
            }
        });
    });
});

function excluir_locatario(id) {

    if (confirm("Você tem certeza que deseja excluir este Locatário?")) {

        var locatario_id = id;

        // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
        $.post(URL_ROOT + 'clientes/deleteLocatario', {
            id: locatario_id
        }, function (resposta) {

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            else {
                alert("Excluído com Sucesso!");
                $('#' + id).remove();
            }
        });
    }
}