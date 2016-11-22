$(document).ready(function(){
    var HOST = 'http://' + window.location.hostname;
    var URL = window.location.pathname.split('/');
    var SERVER = HOST;

    if( HOST == 'http://localhost'){
        SERVER = HOST + '/' + URL[1] + '/' + URL[2];
        URL = URL[3];
    }

	// Fields: btn novo
    $(document).on('click', 'form.fields button.enviar', function(e){
        e.preventDefault();
        $('#modalForms').modal('show');
        $('#modalForms .modal-body').html('<img src="' + SERVER + '/NanoCMS/img/loading.gif" class="loading" title="Processando ..." alt="Processando ..." />');

        var data =  $('form.fields').serialize();
        token = $('input[name=_token]').val();

        $.ajax({
             url : SERVER + '/cms/fields/inserir',
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: data,
             dataType: 'json',
             success: function(result){
                setTimeout(function(){
                    $('#modalForms .modal-body').html('<p class="alert alert-' + result.type + '">' + result.msg + '</p>');
                    if(result.type == 'success'){
                        $('form.fields').trigger("reset");
                        var HTML = '<tr>'
                                    + '<td>' 
                                        + '<a href="' + SERVER + '/cms/fields/' + result.fieldId + '/editar" title="Editar" rel="' + result.fieldId + '">'
                                                + '<button type="button" class="btn btn-primary btn-xs ">'
                                                    + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-edit"></i></span>'
                                                + '</button>'
                                            + '</a>&nbsp;'
                                            + '<a href="' + SERVER + '/cms/fields/' + result.fieldId + '/lixeira" title="Descartar" class="delete" rel="' + result.fieldId + '">'
                                                + '<button type="button" class="btn btn-danger btn-xs ">'
                                                    + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>'
                                                + '</button>'
                                            + '</a>'
                                    + '</td>'
                                    + '<td>' + result.fieldNome + '</td>'
                                    + '<td>' + result.fieldValor + '</td>'
                                    + '<td>' + result.fieldPlaceholder + '</td>'
                                    + '<td>' + result.fieldMask + '</td>'
                                    + '<td>' + result.fieldObrigatorio + '</td>'
                                    + '<td>' + result.fieldTipo + '</td>'
                                    + '<td>' + result.fieldOrdem + '</td>'
                                + '</tr>';

                        if(result.resposta == 'editado'){
                            $('form.fields .editar[rel=' + result.fieldId + ']').parent().parent().remove();
                            $('form.fields input[name=editId]').val('');
                            $('form.fields .separator').parent().before(HTML);
                        }else{
                            $('form.fields .separator').parent().before(HTML);
                        }
                        
                        $('.optionData').remove();
                        $('.form.fields select[name=tipo] optgroup').append('<option value="' + result.fieldId + '">' + result.menuItemTitulo + '</option>');
                    }    
                }, 2000);     
            }
        });
    });

    // Fields: btn editar
    $(document).on('click', 'form.fields .editar', function(e){
        e.preventDefault();
        
        var id = $(this).attr('rel');
        token = $('input[name=_token]').val();
        $.ajax({
             url : $(this).attr('href'),
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: 'editId=' +  id,
             dataType: 'json',
             success: function(result){
                $('form.fields select option').each(function(){
                    $(this).removeAttr('selected');
                });

                if(result.fieldTipo == 'select' || result.fieldTipo == 'checkbox'){
                    $('#modalFields').modal('show');

                    if(result.fieldOptions !== null){
                        var options = result.fieldOptions;
                        for (i = 0; i < options.length; i++) {
                            var html = '<tr>'
                                + '<td>'
                                    + '<a href="' + SERVER + '/cms/fields/' + options[i].id + '/lixeira" title="Descartar" class="delete" rel="' + options[i].id + '">'
                                        + '<button type="button" class="btn btn-danger btn-xs">'
                                            + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>'
                                        + '</button>'
                                    + '</a>'
                                + '</td>'
                                + '<td>' + options[i].nome + '</td>'
                                + '<td>' + options[i].valor + '</td>'
                                + '<td>' + options[i].ordem + '</td>'
                            + '</tr>';
                            $('form.options .separator').parent().before(html);
                        }
                    }
                }

                $('form.fields input[name=editId]').val(id);
                $('form.fields input[name=nome]').val(result.fieldNome);
                $('form.fields input[name=valor]').val(result.fieldValor);
                $('form.fields input[name=placeholder]').val(result.fieldPlaceholder);
                $('form.fields select[name=mascara_id] option[value=' + result.fieldMask + ']').attr('selected', 'selected');
                $('form.fields select[name=tipo] option[value=' + result.fieldTipo + ']').attr('selected', 'selected');
                $('form.fields select[name=obrigatorio] option[value=' + result.fieldObrigatorio + ']').attr('selected', 'selected');
                $('form.fields input[name=ordem]').val(result.fieldOrdem);  
                $('.optionData').remove();
            }
        });
    });

    // Fields: btn delete
    $(document).on('click', 'form.fields .delete', function(e){
        e.preventDefault();
        $('#modalForms').modal('show');
        $('#modalForms .modal-body').html('<img src="' + SERVER + '/NanoCMS/img/loading.gif" class="loading" title="Processando ..." alt="Processando ..." />');

        var id = $(this).attr('rel');
        token = $('input[name=_token]').val();
        $.ajax({
             url : $(this).attr('href'),
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: 'editId=' +  id,
             dataType: 'json',
             success: function(result){
                setTimeout(function(){
                    $(this).parents('form').find('.separator').html('<p class="alert alert-' + result.type + '">' + result.msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">×</span></p>');
                    if(result.type == 'success'){
                        $('.delete[rel=' + id + ']').parent().parent().remove();  
                        $('form.fields select[name=tipo] optgroup option[value=' + id + ']').remove(); 
                    }              
                }, 2000);     
            }
        });
    });

    // Options: btn inserir
    $(document).on('submit', 'form.options', function(e){
        e.preventDefault();
        var value = JSON.stringify($(this).serializeArray());
        var data =  $(this).serializeArray();
        var nome = data[0];
        var valor = data[1];
        var ordem = data[2];

        if(nome.value == '' || valor.value == '' || ordem.value == ''){
            $('#modalFields .separator').html('<p class="alert alert-danger">Atenção! Todos os campos são obrigatórios.<button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">×</span></button></p>');
            return false;
        }

        $('form.fields').append('<input type="hidden" class="optionData" name="optionData[]" value=\'' + value + '\' rel="' + valor.value + '">');
        var html = '<tr>'
                    + '<td>'
                        + '<a href="" title="Descartar" class="delete" rel="' + valor.value + '">'
                            + '<button type="button" class="btn btn-danger btn-xs">'
                                + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>'
                            + '</button>'
                        + '</a>'
                    + '</td>'
                    + '<td>' + nome.value + '</td>'
                    + '<td>' + valor.value + '</td>'
                    + '<td>' + ordem.value + '</td>'
                + '</tr>';
        $('form.options .separator').parent().before(html);
        $(this).trigger("reset");   
        return false;
    });    

    // Options: btn excluir
    $(document).on('click', 'form.options .delete', function(e){
        e.preventDefault();
        if($(this).attr('href') !== ''){
            var id = $(this).attr('rel');
            token = $('input[name=_token]').val();
            $.ajax({
                 url : $(this).attr('href'),
                 headers: {'X-CSRF-TOKEN': token},
                 type : 'POST', 
                 data: 'editId=' +  id,
                 dataType: 'json',
                 success: function(result){
                    $('.delete[rel=' + id + ']').parent().parent().remove();
                    $('#modalFields .separator').html('<p class="alert alert-' + result.type + '">' + result.msg + '</p>');
                    setTimeout(function(){
                        if(result.type == 'success'){
                            $('#modalOptions .separator').html('');
                        }
                    }, 2000);     
                }
            });
        }else{
            $(this).parent().parent().remove();
            $('form.fields input[rel=' + $(this).attr('rel') + ']').remove();
        }
    });

    // Options: btn editar
    $(document).on('change', 'form.fields select[name=tipo]', function(e){
        e.preventDefault();
        if($(this).val() == 'select' || $(this).val() == 'checkbox'){
            $('#modalFields').modal('show');

            if($(this).parents('form').find('.editId').val() !== ''){
                var id = $(this).attr('rel');
            }else{
                $('#modalFields input[name=optionData]').val('');
            }
        }
    });
});