$(document).ready(function () {
    $(".tel").inputmask({
        mask: ["(99) 9999-9999", "(99) 99999-9999"]
    });
    $('.hora').inputmask("99:99");
    $('.cep').inputmask("99999-999");
    $('.cpf').inputmask("999.999.999-99");
    $('.cnpj').inputmask("99.999.999/9999-99");
    $('.data').inputmask("99/99/9999");
    
    $(".valor").maskMoney({
        prefix:'R$ ', 
        allowZero: true, 
        thousands:'.', 
        decimal:',', 
        affixesStay: false});
});