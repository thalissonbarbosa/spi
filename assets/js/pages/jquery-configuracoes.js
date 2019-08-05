// ============ CADASTRAR RECURSOS ============
$(function ($) {
    $("#insert_recurso").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertRecurso', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});

// ============ EDITAR RECURSOS ============
$(function ($) {
    $("#update_recurso").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateRecurso', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Editado com Sucesso!");
                window.location.href = URL_ROOT + "configuracoes/recursos/";
            }
        });
    });
});

// ------ EXCLUIR RECURSO
function excluir_recursos(idRecurso, recurso) {
    if (confirm("Você tem certeza que deseja excluir este recurso?")) {

        var id = idRecurso;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/deleteRecurso', {id: id, recurso: recurso}, function (resposta) {

            $('.overlay').remove();
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $("#" + idRecurso).remove();
                //alert("Excluído com Sucesso!");
                //window.location.reload();
            }
        });
    }
}


// ============ CADASTRAR ATRIBUTOS ============
$(function ($) {
    $("#insert_atributo").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertAtributo', $(this).serialize(), function (resposta) {
            // Quando terminada a requisição
            $('.overlay').remove();

            // Se a resposta é um erro
            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});

// ============ EDITAR ATRIBUTOS ============
$(function ($) {
    $("#update_atributo").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateAtributo', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Alterado com Sucesso!");
                window.location.href = URL_ROOT + "configuracoes/atributos/";

            }
        });
    });
});

// ------ EXCLUIR ATRIBUTO
function excluir_atributos(idAtributo, atributo) {

    if (confirm("Você tem certeza que deseja excluir este atributo?")) {
        var id = idAtributo;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/deleteAtributo', {id: id, atributo: atributo}, function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {

                $("#messages").html(resposta);
            } else {
                $("#" + atributo.toLowerCase()).remove();
                //alert("Atributo excluído com sucesso!");
                //window.location.reload();
            }
        });
    }
}

// ============ CADASTRAR CATEGORIAS ============
$(function ($) {
    $("#insert_categoria").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertCategoria', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Categoria cadastrada com sucesso!");
                window.location.reload();
            }
        });
    });
});


// ============ ALTERAR CATEGORIA ============
$(function ($) {
    $("#update_categoria").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        $.post(URL_ROOT + 'configuracoes/updateCategoria', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Alterado com sucesso!");
                window.location.href = URL_ROOT + "configuracoes/categorias/";
            }
        });
    });
});


// ------ EXCLUIR CATEGORIAS
function excluir_categorias(idCategoria, categoria) {

    if (confirm("Você tem certeza que deseja excluir esta categoria?")) {
        var id = idCategoria;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/deleteCategoria', {id: id, categoria: categoria}, function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                $("#" + categoria.toLowerCase()).remove();
                //alert("Excluído com sucesso!");
                //window.location.reload();
            }
        });
    }

}


// ============ CADASTRAR TIPOS ============
$(function ($) {

    $("#insert_tipo").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertTipo', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});


// ============ ALTERAR TIPO ============
$(function ($) {

    $("#update_tipo").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateTipo', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Alterado com sucesso!");
                window.location.href = URL_ROOT + "configuracoes/tipos/";
            }
        });
    });
});

// ------ EXCLUIR TIPOS
function excluir_tipos(idTipo, tipo) {

    if (confirm("Você tem certeza que deseja excluir este tipo?")) {
        var id = idTipo;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/deleteTipo', {id: id, tipo: tipo}, function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $("#" + idTipo).remove();
                //alert("Excluído com Sucesso!");
                //window.location.reload();
            }
        });
    }

}

// ============ CADASTRAR CORRETORES ============
$(function ($) {
    $("#insert_corretor").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertCorretor', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});


// ============ ALTERAR CORRETORES ============
$(function ($) {
    $("#update_corretor").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateCorretor', $(this).serialize(), function (resposta) {
            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Alterado com sucesso!");
                window.location.href = URL_ROOT + "configuracoes/corretores/";
            }
        });
    });
});

// ------ EXCLUIR CORRETORES
function excluir_corretores(idCorretor, corretor) {

    if (confirm("Você tem certeza que deseja excluir este corretor?")) {
        var id = idCorretor;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/deleteCorretor', {id: id, corretor: corretor}, function (resposta) {

            $('.overlay').remove('');

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $("#" + idCorretor).remove();
                //alert("Excluído com sucesso!");
                //window.location.reload();
            }
        });
    }

}

// ============ CADASTRAR STATUS ============
$(function ($) {
    $("#insert_status").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertStatus', $(this).serialize(), function (resposta) {
            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});


// ============ ALTERAR STATUS ============
$(function ($) {
    $("#update_status").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateStatus', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Alterado com sucesso!");
                window.location.href = URL_ROOT + "configuracoes/status/";
            }
        });
    });
});


// ------ EXCLUIR STATUS
function excluir_status(idStatus, status) {

    if (confirm("Você tem certeza que deseja excluir este status?")) {
        var id = idStatus;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        $.post(URL_ROOT + 'configuracoes/deleteStatus', {id: id, status: status}, function (resposta) {

            $('.overlay').remove();
            if (resposta != false) {

                $("#messages").html(resposta);
            } else {
                $("#" + idStatus).remove();
                //alert("Excluído com Sucesso!");
                //window.location.reload();
            }
        });
    }
}

// ============ CADASTRAR PRESTADORES ============
$(function ($) {
    $("#insert_prestador").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertPrestador', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});

// ============ ALTERAR PRESTADORES ============
$(function ($) {
    $("#update_prestador").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updatePrestador', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                // Add div de erro
                $("#messages").html(resposta);
            } else {
                alert("Alterado com sucesso!");
                window.location.href = URL_ROOT + "configuracoes/prestadores/";
            }
        });
    });
});

// ------ EXCLUIR PRESTADOR
function excluir_prestador(idPrestador, prestador) {

    if (confirm("Você tem certeza que deseja excluir este prestador?")) {
        var id = idPrestador;

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/deletePrestador', {id: id, prestador: prestador}, function (resposta) {

            $('.overlay').remove();
            // Se a resposta é um erro
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $("#" + idPrestador).remove();
                // alert("Excluído com sucesso!");
                //window.location.reload();
            }
        });
    }

}

// ============ CADASTRAR TIPO SERVIÇOS ============
$(function ($) {
    $("#insert_servicos_tipo").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertServico', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Cadastrado com Sucesso!");
                window.location.reload();
            }
        });
    });
});

// ============ EDITAR TIPO SERVIÇOS ============
$(function ($) {
    $("#update_servicos_tipo").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateServico', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Alterado com Sucesso!");
                window.location.href = URL_ROOT + 'configuracoes/servicos';
            }
        });
    });
});


// ------ EXCLUIR TIPO SERVIÇOS
function excluir_servicos_tipo(idTipoServicos, tipo) {

    if (confirm("Você tem certeza que deseja excluir este Tipo de Serviço?")) {
        var id = idTipoServicos;
        
        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        
        $.post(URL_ROOT + 'configuracoes/deleteServico', {id: id, tipoServico: tipo}, function (resposta) {

            $('.overlay').remove();
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $("#" + id).remove();
                //alert("Excluído com Sucesso!");
                //window.location.reload();
            }
        });
    }
}

// ============ CADASTRAR USUARIOS ============
$(function ($) {

    $("#insert_usuario").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/insertUsuario', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            }
            // Se resposta for false, ou seja, não ocorreu nenhum erro
            else {
                alert("Cadastrado com Sucesso!");
                window.location.href = URL_ROOT + 'configuracoes/usuarios';
            }
        });
    });
});

// ============ EDITAR USUÁRIO ~ Configurar ============
$(function ($) {

    $("#update_usuario").submit(function (ev) {

        ev.preventDefault();

        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');

        $.post(URL_ROOT + 'configuracoes/updateUsuario', $(this).serialize(), function (resposta) {

            $('.overlay').remove();

            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                alert("Alterado com Sucesso!");
                window.location.href = URL_ROOT + "configuracoes/usuarios/";
            }
        });
    });
});

// ------ EXCLUIR USUARIOS
function delete_usuario(idUsuario, login) {

    if (confirm("Você tem certeza que deseja excluir este usuário?")) {
        var id = idUsuario;
        
        $('.alert').remove();
        $('.box').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        
        $.post(URL_ROOT + 'configuracoes/deleteUsuario', {id: id, login: login}, function (resposta) {
            
            $('.overlay').remove();
            
            if (resposta != false) {
                $("#messages").html(resposta);
            } else {
                $('#' + id).remove();
                //alert("Excluído com Sucesso!");
                //window.location.reload();
            }
        });
    }

}