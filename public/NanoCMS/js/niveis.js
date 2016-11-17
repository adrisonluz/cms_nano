$(document).ready(function(){
    // Niveis: btn novo
    $(document).on('click', '#btnNivel', function(e){
        e.preventDefault();
        $('#modalNiveis').modal('show');
        $('#modalNiveis .modal-body').html('<img src="' + SERVER + '/img/loading.gif" class="loading" title="Processando ..." alt="Processando ..." />');

        token = $('input[name=_token]').val();
        $.ajax({
             url : SERVER + '/nivel/inserir',
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: 'nivel=' +  $('.inputNivel').val(),
             dataType: 'json',
             success: function(result){
                setTimeout(function(){
                    $('#modalNiveis .modal-body').html('<p class="alert alert-' + result.type + '">' + result.msg + '</p>');
                    if(result.type == 'success'){
                        $('.divNiveis').append('<div class="col-sm-4">'
                            + '<a href="' + SERVER + '/nivel/' + result.nivelId + '/lixeira" class="nivelDelete" rel="' + result.nivelId + '" data-toggle="modal" data-target="#modaNiveis" title="Descartar">'
                                + '<button type="button" class="btn btn-danger btn-xs ">'
                                    + '<span class="glyphicon" aria-hidden="true"><i class="fa fa-trash"></i></span>'
                                + '</button>'
                            + '</a>'
                            + '<span text=""> &nbsp; ' + result.nivelName + '</span>'
                        + '</div>');
                        $('.ctrlAcessos select.select2').append('<option value="' + result.nivelId + '">' + result.nivelName + '</option>');
                    }    
                }, 2000);     
            }
        });
    });

    // Niveis: btn delete
    $(document).on('click', '.nivelDelete', function(e){
        e.preventDefault();
        $('#modalNiveis').modal('show');
        $('#modalNiveis .modal-body').html('<img src="' + SERVER + '/img/loading.gif" class="loading" title="Processando ..." alt="Processando ..." />');

        var id = $(this).attr('rel');
        token = $('input[name=_token]').val();
        $.ajax({
             url : $(this).attr('href'),
             headers: {'X-CSRF-TOKEN': token},
             type : 'POST', 
             data: 'nivel=' +  id,
             dataType: 'json',
             success: function(result){
                setTimeout(function(){
                    $('#modalNiveis .modal-body').html('<p class="alert alert-' + result.type + '">' + result.msg + '</p>');
                    if(result.type == 'success'){
                        $('.nivelDelete[rel=' + id + ']').parent().remove();  
                        $('.ctrlAcessos select.select2 option[value=' + id + ']').remove();    
                    }              
                }, 2000);     
            }
        });
    });
});