// ============ CADASTRAR IMOVEL ============
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#insert_imovel").submit(function (ev) {

        ev.preventDefault();
        
        // Exibe mensagem de carregamento
        $(".alert").remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
        $.post(URL_ROOT + 'imovel/insertImovel', $(this).serialize(), function (resposta) {

            $(".overlay").remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                var codigo = $('#codigo').val();
                alert("Imóvel cadastrado com Sucesso!");
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });
    });
});

// ============ EDITAR IMOVEL ============
$(function ($) {

    $("#update_imovel").submit(function (ev) {

        ev.preventDefault();

        // Exibe mensagem de carregamento
        $(".alert").remove();
        $(".box").append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'imovel/updateImovel', $(this).serialize(), function (resposta) {

            $(".overlay").remove();
            if (resposta != false) {
                // Add div de erro
                $('#messages').html(resposta);
            } else {
                var codigo = $('#codigo').val();
                alert("Alterado com sucesso!");
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });

    });
});

// ============ SET WELL ============
function setWell(tipo, id, nome) {

    var codigo_imovel = $("#codigo").val();
    var input;
    var id_name;

    if (tipo == "locatario") {
        input = "locatarios";
        id_name = "loca-";
    }
    if (tipo == "proprietario") {
        input = "proprietarios";
        id_name = "prop-";
    }


    var html = '';
    html += '<div id="' + id_name + id + '" class="well well-sm" style="width:40%">' + nome;

    html += '<a href="#" id="' + id_name + id + '" class="pull-right text-black" onClick="removerInput(this, ' + "'" + codigo_imovel + "'" + ", '" + id + "'" + ')">';
    html += '<kbd><i class="fa fa-times"></i></kbd>';
    html += '</a>';

    html += '<input type="hidden" name="' + input + '[]" class="form-control" value="' + id + '" />';
    html += '</div>';

    $("#" + input + "-content").append(html);

}

// ============ REMOVER INPUT PROP/CLIENTE ============
function removerInput(Input, Codigo, Id) {

    if (confirm("Tem certeza que você deseja retirar este cliente do imóvel?")) {
        var input = $(Input).attr('id');
        var id = Id;
        var codigo = Codigo;

        if (input.slice(0, 4) == 'prop') {
            var local = 'imovel/deleteProprietario';
        } else {
            var local = 'imovel/deleteLocatario';
        }
        $.post(URL_ROOT + local, {
            id: id, codigo: codigo
        }, function (resposta) {
            if (resposta != false) {
                // Exibe o erro na div
                $("#messages").html(resposta);
            } else {
                $('#' + input).remove();
            }
        });
    }
}