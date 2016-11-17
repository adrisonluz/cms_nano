$(document).ready(function(){
	// Itens de menu: btn novo
    $(document).on('click', 'form.menus-itens button.enviar', function(e){
        e.preventDefault();
        $('#modalMenusItens').modal('show');
        $('#modalMenusItens .modal-body').html('<img src="' + SERVER + '/img/loading.gif" class="loading" title="Processando ..." alt="Processando ..." />');

        var data =  $('form.menus-itens').serialize();
        token = $('input[name=_token]').val();

        $.ajax({
             url : SERVER + '/cms/menus-itens/inserir',
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: data,
             dataType: 'json',
             success: function(result){
                setTimeout(function(){
                    $('#modalMenusItens .modal-body').html('<p class="alert alert-' + result.type + '">' + result.msg + '</p>');
                    if(result.type == 'success'){
                        $('form.menus-itens').trigger("reset");
                        var HTML = '<tr>'
                                    + '<td>' 
                                        + '<a href="' + SERVER + '/cms/menus-itens/' + result.menuItemId + '/editar" title="Editar" rel="' + result.menuItemId + '">'
                                                + '<button type="button" class="btn btn-primary btn-xs ">'
                                                    + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>'
                                                + '</button>'
                                            + '</a>&nbsp;'
                                            + '<a href="' + SERVER + '/cms/menus-itens/' + result.menuItemId + '/lixeira" title="Descartar" class="delete" rel="' + result.menuItemId + '">'
                                                + '<button type="button" class="btn btn-danger btn-xs ">'
                                                    + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>'
                                                + '</button>'
                                            + '</a>'
                                    + '</td>'
                                    + '<td>' + result.menuItemTitulo + '</td>'
                                    + '<td>' + result.menuItemLink + '</td>'
                                    + '<td>' + result.menuItemTipo + '</td>'
                                    + '<td>' + result.menuItemAtivo + '</td>'
                                + '</tr>';

                        if(result.resposta == 'editado'){
                            $('form.menus-itens .editar[rel=' + result.menuItemId + ']').parent().parent().remove();
                            $('form.menus-itens input[name=editId]').val('');
                            $('form.menus-itens .separator').parent().before(HTML);
                        }else{
                            $('form.menus-itens .separator').parent().before(HTML);
                        }
                        

                        $('.form.menus-itens select[name=tipo] optgroup').append('<option value="' + result.menuItemId + '">' + result.menuItemTitulo + '</option>');
                    }    
                }, 2000);     
            }
        });
    });

    // Itens de menu: btn editar
    $(document).on('click', 'form.menus-itens .editar', function(e){
        e.preventDefault();
        var pai = $(this).parent().parent();
        var titulo = pai.find('.titulo').text();
        var link = pai.find('.link').text();
        var tipo = pai.find('.tipo').attr('rel');
        var ativo = pai.find('.ativo').attr('rel');
        var editId = $(this).attr('rel');

        if(tipo == 0){
            tipo = 'item';
        }

        $('form.menus-itens select option').each(function(){
            $(this).removeAttr('selected');
        });

        $('form.menus-itens input[name=titulo]').val(titulo);
        $('form.menus-itens input[name=link]').val(link);
        $('form.menus-itens select[name=tipo] option[value=' + tipo + ']').attr('selected', 'selected');
        $('form.menus-itens select[name=ativo] option[value=' + ativo + ']').attr('selected', 'selected');
        $('form.menus-itens input[name=editId]').val(editId);
    });

    // Itens de menu: btn delete
    $(document).on('click', 'form.menus-itens .delete', function(e){
        e.preventDefault();
        $('#modalMenusItens').modal('show');
        $('#modalMenusItens .modal-body').html('<img src="' + SERVER + '/img/loading.gif" class="loading" title="Processando ..." alt="Processando ..." />');

        var id = $(this).attr('rel');
        token = $('input[name=_token]').val();
        $.ajax({
             url : $(this).attr('href'),
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: 'id=' +  id,
             dataType: 'json',
             success: function(result){
                setTimeout(function(){
                    $('#modalMenusItens .modal-body').html('<p class="alert alert-' + result.type + '">' + result.msg + '</p>');
                    if(result.type == 'success'){
                        $('.delete[rel=' + id + ']').parent().parent().remove();  
                        $('.form.menus-itens select[name=tipo] optgroup option[value=' + id + ']').remove();    
                    }              
                }, 2000);     
            }
        });
    });
});