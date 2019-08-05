// ================= LOGIN =================
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#login").submit(function (ev) {

        ev.preventDefault();

        // Exibe mensagem de carregamento
        $(".alert").remove();
        $(".loading").html('<span class="lead"><i class="fa fa-spinner fa-spin"></i></span> <small>Aguarde...</small>');

        $.post(URL_ROOT + 'usuario/logar', $(this).serialize(), function (resposta) {

            $(".loading").html('');

            if (resposta != false) {
                $('.status').html(resposta);
            } else {
                $('.loading').html('<span class="lead"><i class="fa fa-spinner fa-spin"></i></span> <small class="text-olive">Redirecionando...</small>');
                window.location.href = '../';
            }

        });

    });
});

// ================== REDEFINIR SENHA =================
$(function ($) {
    $("#redefinir_senha").submit(function (ev) {

        ev.preventDefault();
        // Exibe mensagem de carregamento
        $(".alert").remove();
        $(".loading").html('<span class="lead"><i class="fa fa-spinner fa-spin"></i></span> <small>Aguarde...</small>');

        $.post(URL_ROOT + 'usuario/redefinirSenha', $(this).serialize(), function (resposta) {

            $(".loading").html('');

            if (resposta != false) {
                $(".status").html(resposta);
            } else {
                alert("Sua senha foi alterada com sucesso!");
                window.location.href = URL_ROOT + 'usuario/login';
            }
        });
    });
});
// ================= RECUPERAR SENHA =================

$(function ($) {
    $("#recuperar_senha").submit(function (ev) {

        ev.preventDefault();

        // Exibe mensagem de carregamento
        $(".alert").remove();
        $(".loading").html('<span class="lead"><i class="fa fa-spinner fa-spin"></i></span> <small>Aguarde...</small>');

        $.post(URL_ROOT + 'usuario/recuperarSenha', $(this).serialize(), function (resposta) {

            $(".loading").html('');

            if (resposta != false) {

                $(".status").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Email enviado com sucesso!");
                window.location.href = URL_ROOT + 'usuario/login';
            }
        });
    });
});

// ============ EDITAR PERFIL ============
$(function ($) {
    // Quando o formulário for enviado, essa função é chamada
    $("#update_perfil").submit(function (ev) {

        ev.preventDefault();
        
        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'usuario/update', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Alterado com sucesso!");
                window.location.reload();
            }
        });
    });
});

