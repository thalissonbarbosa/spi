// ============ ADD ATRIBUTOS ============
$(function ($) {
    $("#add-atributos").submit(function (ev) {

        ev.preventDefault();

        var codigo = $("#codigo").val();
        var atributo_id = $("#atributo").val();
        var qtd = $("#qtd").val();

        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".loading").append('<i class="fa fa-spinner fa-spin"></i> Aguarde...');

        $.post(URL_ROOT + 'imovel/addAtributo', {
            codigo: codigo, atributo_id: atributo_id, qtd: qtd
        }, function (resposta) {

            $(".loading").hide();

            if (resposta != false) {
                $(".messages_modal").html(resposta);
            } else {
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });
        $(this).safeform('complete');
    });
});

// ============ DELETE ATRIBUTO ============
function delete_atributo(idAtributo, codigo) {

    if (confirm("Você tem certeza que deseja excluir este atributo?")) {

        var atributo_id = idAtributo;
        var codigo = codigo;

        $.post(URL_ROOT + 'imovel/removeAtributo', {
            atributo_id: atributo_id, codigo: codigo
        }, function (resposta) {

            if (resposta != false) {
                // Exibe o erro na div
                $("#messages").html(resposta);
            } else {
                $("#atributo-" + atributo_id).fadeOut(300, function () {
                    $(this).remove();
                });
                //window.location.href = URL_ROOT + 'imovel/detalhes/' + ref;
            }
        });
    }
}

// ============ UPDATE RECURSOS ============
$(function ($) {
    $("#update_recursos").submit(function (ev) {

        ev.preventDefault();

        var camposMarcados = new Array();
        $("input[type=checkbox][name='recursos[]']:checked").each(function () {
            camposMarcados.push($(this).val());
        });
        var codigo = $("#codigo").val();

        // Fecha a div de error se existir
        $(".alert").remove();
        // Exibe mensagem de carregamento
        $(".loading").append('<i class="fa fa-spinner fa-spin"></i> Aguarde...');

        $.post(URL_ROOT + 'imovel/updateRecurso', {
            codigo: codigo, camposMarcados: camposMarcados
        }, function (resposta) {

            $(".loading").hide();

            if (resposta != false) {

                $(".messages_modal").html(resposta);
            } else {
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });

    });
});

// ============ DISABLE IMOVEL ============
function disable_imovel(codigo) {
    if (confirm("Tem certeza que deseja desabilitar este imóvel?")) {
        var codigo = codigo;
        $.post(URL_ROOT + 'imovel/disableImovel', {
            codigo: codigo
        }, function (resposta) {

            // Se a resposta é um erro
            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Imóvel desabilitado com sucesso!");
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });
    }
}

// ============ ENABLE IMOVEL ============
function enable_imovel(codigo) {
    if (confirm("Tem certeza que deseja habilitar este imóvel?")) {
        var codigo = codigo;

        $.post(URL_ROOT + 'imovel/enableImovel', {
            codigo: codigo
        }, function (resposta) {

            // Se a resposta é um erro
            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Imóvel habilitado com sucesso!");
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });
    }
}