// ================= CADASTRAR LOCATARIO =================
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#insert_fiador").submit(function (ev) {

        ev.preventDefault();
        
        // Exibe mensagem de carregamento
        $('.alert').remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'clientes/insertFiador', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            else {
                alert("Cadastrado com Sucesso!");
                window.location.href = URL_ROOT + "clientes/fiadores";
            }
        });
    });
});

// ================= EDITAR CLIENTE =================
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#update_fiador").submit(function (ev) {
        
        ev.preventDefault();

        $('.alert').remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        
        $.post(URL_ROOT + 'clientes/updateFiador', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            else {
                alert("Editado com Sucesso!");
                window.location.href = URL_ROOT + "clientes/fiadores";
            }
        });
    });
});

// ================= BUSCA LOCATARIO =================

$(function ($) {
    $(".buscaFiadores").submit(function () {

        var busca = $("#buscaFiadores").val();

        var local = "clientes/searchFiador";
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

function excluir_fiador(id) {

    if (confirm("Você tem certeza que deseja excluir este Fiador?")) {


        // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
        $.post(URL_ROOT + 'clientes/deleteFiador', {
            id: id
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