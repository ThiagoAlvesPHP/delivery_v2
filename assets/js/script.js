$(function(){

    $('.phone').mask('(00) 0 0000-0000');
    $('.cep').mask('00000-000');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.cpf').mask('000.000.000-00');
    $('.price').mask('##0.00', {reverse: true});

    $('.bt-acao').on('click keyup', function(e){
        e.preventDefault();

        var qt = parseInt($('.quantidade').val());
        var action = $(this).attr('data-action');
        let div = $(this).parent();
        let valor = parseFloat(div.find('.subtotal span').html().replace(',', '.'));
        let preco = div.find('.valor').val();

        if(action == 'decrease') {
            if(qt-1 >= 1) {
                qt = qt - 1;
                valor = parseFloat(valor) - parseFloat(preco);
            }
        }
        if(action == 'increase') {
            qt = qt + 1;
            valor += parseFloat(preco);
        }
        $('.quantidade').val(qt);
        $(div.find('.subtotal span')).html(valor.toFixed(2));
    });

    $('.btn-acrescimo').on('click keyup', function(e){
        e.preventDefault();
        let div = $(this).parent().parent();
        var qt = parseInt($(div.find('.qt_acrescimo')).val());
        var action = $(this).attr('data-action');
        var preco =  parseFloat($($(div.find('span'))).html());
        let valor = parseFloat(div.parent().parent().parent().parent().find('.subtotal span').html().replace(',', '.'));


        if(action == 'decrease') {
            qt = qt - 1;
            valor = parseFloat(valor) - parseFloat(preco);
        }
        if(action == 'increase') {
            qt = qt + 1;
            valor += parseFloat(preco);
        }

        let sub = preco * qt;

        $(div.find('.qt_acrescimo')).val(qt);
        $(div.parent().parent().parent().parent().find('.subtotal span')).html(valor.toFixed(2));
    });

    $(document).ready(function (){
        $('#produtos').DataTable({
            "processing": true,
            "serverSide": true,
            "language": {
                "lengthMenu": "_MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(Filtrado de _MAX_ registros no total)",
                "sSearch": "Pesquisar",
                "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
                },
            },
            "ajax": {
                "url": url+"produtos/ajax",
                "type": "POST"
            }
        });
    });
    //definir produtos por categoria ajax
    $(document).on('click', '.id_categoria', function(){
        let id_categoria = $(this).val();
        
        $.ajax({
            type: 'POST',
            url: url+'home/ajax',
            data:{ id_categoria:id_categoria },
            success:function(data){
                $('#lista-produtos-categoria').html(data).fadeIn("slow");
            }
        });
    });

    //verificar qual a forma de entrega o cliente escolheu
    $(document).on('click', '.forma-entrega', function(){
        let value = $(this).val();
        //se for entregar em casa
        if (value == 1) {
            $('.formulario-interno').removeAttr('hidden');
            $('.success-cart').attr('disabled', true);
            $('.endereco').attr('required', true);
            $('.bairro').attr('required', true);
            $('.cidade').attr('required', true);
        }
        //se for buscar na loja
        if (value == 2) {
            $('.formulario-interno').attr('hidden', true);
            $('.success-cart').removeAttr('disabled');
            $('.endereco').removeAttr('required');
            $('.bairro').removeAttr('required');
            $('.cidade').removeAttr('required');
        }
    });
    //verificar qual a forma de pagamento o cliente escolheu
    $(document).on('click', '.forma-pagamento', function(){
        let value = $(this).val();
        //dinheiro
        if (value == 1) {
            $('.formulario-interno2').removeAttr('hidden');
            $('.troco').attr('required', true);
        }
        //cartão
        if (value == 2) {
            $('.formulario-interno2').attr('hidden', true);
            $('.troco').removeAttr('required');
        }
        $('.success-cart').removeAttr('disabled');
    });

});
