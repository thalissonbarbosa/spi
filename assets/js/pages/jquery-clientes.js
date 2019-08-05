// ============ SET WELL Fiador/Locatario ============
function setWell(tipo, id, nome) {


    var html = '';
    html += '<div id="' + tipo + '-' + id + '" class="well well-sm" style="width:40%">' + nome;

    html += '<a href="#" id="' + tipo + '-' + id + '" class="pull-right text-black" onClick="removerWell(' + "'" + tipo + "'" + ", '" + id + "'" + ')">';
    html += '<kbd><i class="fa fa-times"></i></kbd>';
    html += '</a>';

    html += '<input type="hidden" name="' + tipo + '[]" class="form-control" value="' + id + '" />';
    html += '</div>';

    $("#" + tipo + "-content").append(html);

}

// ============ REMOVER WELL Fiador/Locatario ============
function removerWell(Tipo, Id) {

    if (confirm("Tem certeza que você deseja retirar este " + Tipo + "?")) {

        var id_locatario;
        var id_fiador;
        
        if (Tipo == 'fiador') {
            if ($('#id').length){
                id_locatario = $('#id').val();
            }else{
                id_locatario = 0;
            }
            id_fiador = Id;
        }
        if (Tipo == 'locatario') {
            id_locatario = Id;
            if ($('#id').length){
                id_fiador = $('#id').val();
            }else{
                id_fiador = 0;
            }
        }

        $.post(URL_ROOT + 'clientes/deleteFiadorAssoc', {
            id_locatario: id_locatario, id_fiador: id_fiador
        }, function (resposta) {
            if (resposta != false) {
                // Exibe o erro na div
                $("#messages").html(resposta);
            } else {
                $('#' + Tipo + '-' + Id).remove();
            }
        });
    }
}


// ============ SET WELL IMOVEL - bootstrap label ============
function setWellImovel(codigo) {

    var id_name = "imovel-";

    var html = '';
    html += '<div id="' + id_name + codigo + '" class="well well-sm" style="width:40%">' + codigo;

    html += '<a href="#" id="' + id_name + codigo + '" class="pull-right text-black" onClick="removerImovel(' + "'" + codigo + "'" + ')">';
    html += '<kbd><i class="fa fa-times"></i></kbd>';
    html += '</a>';

    html += '<input type="hidden" name="imovel[]" class="form-control" value="' + codigo + '" />';
    html += '</div>';

    $("#imovel-content").append(html);

}

// ============ REMOVER IMOVEL Page proprietario/locatario ============
function removerImovel(Codigo) {
    if (confirm("Tem certeza que você deseja retirar este imóvel?")) {

        // Id do Cliente
        var id;
        if ($("#id").length) {
            id = $("#id").val();
        } else {
            id = 0;
        }
        // Ref do Imovel
        var codigo = Codigo;
        // Pagina
        var page = $("#page").val();
        // nome da function
        var local;

        if (page == 'locatarios') {
            local = 'imovel/deleteLocatario';
        }
        if (page == 'proprietarios') {
            local = 'imovel/deleteProprietario';
        }

        $.post(URL_ROOT + local, {
            id: id, codigo: codigo
        }, function (resposta) {
            if (resposta != false) {
                // Exibe o erro na div
                $("#messages").html(resposta);
            } else {
                $('#imovel-' + codigo).remove();
            }
        });
    }
}