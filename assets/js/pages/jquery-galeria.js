$(document).ready(function () {
    $('.fancybox').fancybox();

});

// ============ DELETE TUDO GALERIA =======

function delete_galeria(codigo_imovel) {
    var codigo = codigo_imovel;

    if (confirm("Tem certeza que deseja excluir todas as imagens?")) {

        // Modal Aguarde
        waitingFor(true);

        $.post(URL_ROOT + 'imovel/deleteGaleria', {codigo: codigo}, function (resposta) {

            if (resposta != false) {
                waitingFor(false);
                $(".statusUploadGaleria").html(resposta);
            } else {
                // Escondendo WaitingFor
                waitingFor(false);
                $('.img-galeria').remove();
                //window.location.href = URL_ROOT + 'imovel/detalhes/' + ref;
            }
        });
    }

}

// ============ DELETE IMAGEM GALERIA ============
function deleteImgGaleria(id_imagem, codigo_imovel, img) {

    if (confirm("Você tem certeza que deseja excluir esta imagem?")) {

        var imagem_id = id_imagem;
        var codigo = codigo_imovel;
        var img = img;

        // Mostrar modal Aguarde
        waitingFor(true);

        $.post(URL_ROOT + 'imovel/deleteImgGaleria', {
            imagem_id: imagem_id, codigo: codigo, img: img
        }, function (resposta) {
            if (resposta != false) {
                // Esconder modal aguarde
                waitingFor(false);
                $("#messages").html(resposta);
            } else {
                // Esconder modal aguarde
                waitingFor(false);
                $("#img-id-" + id_imagem).fadeOut(300, function () {
                    $(this).remove();
                });
                //window.location.href = URL_ROOT + 'imovel/detalhes/' + ref + '/#galeria';
            }
        });
    }
}

// ============ DELETE IMAGEM PRINCIPAL ============
function deleteImgPrincipal(codigo, img) {

    if (confirm("Você tem certeza que deseja excluir esta imagem?")) {

        var codigo = codigo;
        var img = img;

        waitingFor(true);

        $.post(URL_ROOT + 'imovel/deleteImgPrincipal', {
            codigo: codigo, img: img
        }, function (resposta) {

            if (resposta != false) {
                waitingFor(false);
                $("#messages").html(resposta);
            } else {
                window.location.href = URL_ROOT + 'imovel/detalhes/' + codigo;
            }
        });
    }
}
