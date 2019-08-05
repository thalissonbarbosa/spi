// ================= CADASTRAR PROPRIETARIO =================
$(function ($) {
    $("#insert_proprietario").submit(function (ev) {
        
        ev.preventDefault();

        $(".alert").remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'clientes/insertProprietario', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.href = URL_ROOT + "clientes/proprietarios/";
            }
        });
    });
});

// ================= EDITAR PROPRIETARIO =================
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#update_proprietario").submit(function (ev) {

        ev.preventDefault();
        
        $(".alert").remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'clientes/updateProprietario', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Alterado com Sucesso!");
                window.location.href = URL_ROOT + "clientes/proprietarios/";
            }
        });
    });
});

// ================= BUSCA PROPRIETARIO =================

$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $(".buscaProprietarios").submit(function () {

        // Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
        var busca = $("#buscaProprietario").val();

        var local = "clientes/searchProprietario";
        var img = "<img src='" + DIR_IMG + "loader.gif' align='center' />";

        // Exibe mensagem de carregamento
        $('.loadingSearch').show();
        $(".loadingSearch").html(img);
        // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST

        $.post(URL_ROOT + local, {busca: busca}, function (resposta) {

            $(".loadingSearch").hide();
            if (resposta == false) {
                $(".tbody").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                $(".tbody").html(resposta);
            }
        });
    });
});

function excluir_proprietario(idProprietario) {

    if (confirm("Você tem certeza que deseja excluir este proprietário?")) {

        var proprietario_id = idProprietario;

        $.post(URL_ROOT + 'clientes/deleteProprietario', {
            id: proprietario_id
        }, function (resposta) {
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Excluído com Sucesso!");
                $('#' + proprietario_id).remove();
            }
        });
    }
}