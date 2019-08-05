$(document).ready(function () {
    // Lista Padrão
    $('#lista').DataTable({
        dom: '<"pull-left"f><"pull-right"l>rt<"pull-left"i><"pull-right"p>',
        "language": {
            "url": URL_ROOT + "assets/plugins/datatables/language/pt_br.json"
        },
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [-1]}
        ],
        "aaSorting": [] // Prevent initial sorting
    });

    jQuery.fn.dataTableExt.oSort['brazilian-asc'] = function (a, b) {
        var x = (a == "-") ? 0 : a.replace(/\./g, "").replace(/,/, ".");
        var y = (b == "-") ? 0 : b.replace(/\./g, "").replace(/,/, ".");
        x = parseFloat(x);
        y = parseFloat(y);
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['brazilian-desc'] = function (a, b) {
        var x = (a == "-") ? 0 : a.replace(/\./g, "").replace(/,/, ".");
        var y = (b == "-") ? 0 : b.replace(/\./g, "").replace(/,/, ".");
        x = parseFloat(x);
        y = parseFloat(y);
        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };
    // Lista de imóveis - Imovel/lista
    $('#lista-imoveis').DataTable({
        dom: '<"pull-left"f><"pull-right"l>rt<"pull-left"i><"pull-right clearfix"p><"clearfix"><"pull-left"B>',
        "language": {
            "url": URL_ROOT + "assets/plugins/datatables/language/pt_br.json"
        },
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [2]}
        ],
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"> </i> Gerar PDF',
                title: 'Lista de Imóveis',
                exportOptions: {
                    columns: [0, 1, 3, 4, 5, 7]
                }
            },
            {
                extend: 'print',
                text: '<span class="glyphicon glyphicon-print"> </span> Imprimir',
                title: '',
                message: 'Lista de Imóveis - Cabral Gama Imobiliária <br />',
                exportOptions: {
                    columns: [0, 1, 3, 4, 5, 7]
                }
            }

        ]
    });

});