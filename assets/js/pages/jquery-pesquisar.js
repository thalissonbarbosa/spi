function submitForm() {

    var ref = $("#ref").val();
    var endereco = $("#endereco").val();
    var bairro = $("#bairro").val();
    var condominio = $("#condominio").val();
    var preco = $("#preco").val();
    var preco2 = $("#preco2").val();
    var zona = $("#zona").val();

    var categoria = $("#categoria").val();
    var tipo = $("#tipo").val();
    var stats = $("#stats").val();


    // Exibe mensagem de carregamento
    $('#resultadoBusca').html('');
    $('.loading').show();
    
    $.post(URL_ROOT + "pesquisar/search", {ref: ref, endereco: endereco, bairro: bairro, condominio: condominio, preco: preco, preco2: preco2, zona: zona, categoria: categoria, tipo: tipo, stats: stats}, function (resposta) {

        $(".loading").hide();

        if (resposta === false) {
            $("#resultadoBusca").html("Nenhum imóvel encontrado.");
        }
        else {

            $("#resultadoBusca").html(resposta);
        }
    });

    
}