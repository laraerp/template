$(function(){
    $('.datepicker').datepicker({
        'format' : 'dd/mm/yyyy'
    });

    $('.cep').mask('00.000-000');
    $('.phone').mask('0000-0000');
    $('.cpf').mask('000.000.000-00');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    $('.telefone').mask(function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }, {onKeyPress: function(val, e, field, options) {
        field.mask(maskBehavior.apply({}, arguments), options);
    }});
});