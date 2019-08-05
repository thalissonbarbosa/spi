/* global */
$(function ($) {
    // Config Local
    //DIR_IMG = "http://php.dev/spi/assets/img/";
    //DIR_LAYOUT = "http://php.dev/spi/app/views/lte-2/";
    //URL_ROOT = "http://php.dev/spi/";
    
    // Config Remote
    DIR_IMG = "http://cabralgama.com/spi/assets/img/";
    DIR_LAYOUT = "http://cabralgama.com/spi/app/views/lte-2/";
    URL_ROOT = "http://cabralgama.com/spi/";

    $('[data-toggle="popover"]').popover();
});

/*
 * Cadastrar Atendimento
 */

$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#cad_atendimento").submit(function (ev) {

        ev.preventDefault();
        
        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".loading").append('<i class="fa fa-spinner fa-spin"></i> Aguarde...');
        
        $.post(URL_ROOT + "atendimento/cadastrar", $(this).serialize(), function (resposta) {

            $(".loading").remove();
            
            if (resposta != false) {
                $('#messages_at').html(resposta);
            } else {
                alert("Atendimento realizado com sucesso!");
                window.location.href = URL_ROOT + "atendimento/";
            }
        });       
        
    });
});

/*
 * Busca rápida
 */
$(function () {
// ================= BUSCA RAPIDA =================
    $(function ($) {
        // Quando o formulário for enviado, essa função é chamada
        $("#search").submit(function () {
            // esconde a div DASHBOARD
            $("#corpo").empty();

            // Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
            var busca = $("#busca").val();

            // Exibe mensagem de carregamento
            $(".loadingSearch").html("<img src='" + DIR_IMG + "loader.gif' />");
            // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST

            $.post(URL_ROOT + 'imovel/searchImovel', {busca: busca}, function (resposta) {
                // Quando terminada a requisição
                // Exibe a div status
                $(".loadingSearch").hide();
                // Se a resposta é um erro
                if (resposta != false) {
                    $("#resultadoBusca").empty();
                    $("#semResultado").empty();
                    $("#resultadoBusca").html(resposta);
                }
                // Se resposta for false, ou seja, não ocorreu nenhum erro
                else {
                    $("#resultadoBusca").empty();
                    $("#semResultado").html("Nenhum imovel encontrado :(");

                }
            });


        });
    });

});

