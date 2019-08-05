/*
 * 
 * Busca atendimento
 */
function submitForm() {
    $(".lista").hide();

    // Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
    var nome = $("#nome").val();
    var zona = $("#zona").val();
    var categoria = $("#categoria").val();

    var img = "<img src='" + DIR_IMG + "loader.gif' align='center' />";

    // Exibe mensagem de carregamento
    $('.loadingSearch').show();
    $(".loadingSearch").html(img);
    // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST

    $.post(URL_ROOT + 'atendimento/busca', {nome: nome, zona: zona, categoria: categoria}, function (resposta) {

        $(".loadingSearch").hide();
        // Se a resposta é um erro
        if (resposta == false) {
            // Exibe o erro na div
            $("#semResultado").html(resposta);
        }
        // Se resposta for false, ou seja, não ocorreu nenhum erro
        else {
            $("#topoBusca").show();
            $(".box-dashboard").html(resposta);
        }
    });
}

/*
 * Editar Atendimento
 */
$(function ($) {
    $("#edit_atendimento").submit(function (ev) {

        ev.preventDefault();

        // remove Alert se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
        $.post(URL_ROOT + 'atendimento/edit', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {

                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Atendimento alterado com sucesso!");
                window.location.href = URL_ROOT + "atendimento/";
            }
        });

    });
});

/*
 * Excluir Atendimento
 */
function excluir_atendimento(idAtendimento, Page) {

    if (confirm("Você tem certeza que deseja excluir este atendimento?")) {
        $.post(URL_ROOT + 'atendimento/excluir', {idAtendimento: idAtendimento}, function (resposta) {
            // Quando terminada a requisição
            // Se a resposta é um erro
            if (resposta != false) {
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                if (Page === true) {
                    alert("Atendimento excluído com sucesso!");
                    window.location.href = URL_ROOT + "atendimento";
                } else {
                    $("#" + idAtendimento).fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            }
        });
    }
}
