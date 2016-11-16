if(document.getElementById('btn-camera')){
    document.getElementById("btn-camera").addEventListener("click", function () {
        var canvas = document.getElementById("canvas"),
        context = canvas.getContext("2d"),
        video = document.getElementById("video"),
        videoObj = {"video": true},
        errBack = function (error) {
            console.log("Erro ao capturar imagem: ", error.code);
        };
        if (navigator.getUserMedia) {
            navigator.getUserMedia(videoObj, function (stream) {
                video.src = stream;
                video.play();
            }, errBack);
        } else if (navigator.webkitGetUserMedia) {
            navigator.webkitGetUserMedia(videoObj, function (stream) {
                video.src = window.webkitURL.createObjectURL(stream);
                video.play();
            }, errBack);
        } else if (navigator.mozGetUserMedia) {
            navigator.mozGetUserMedia(videoObj, function (stream) {
                video.src = window.URL.createObjectURL(stream);
                video.play();
            }, errBack);
        }
    }, false);

    document.getElementById("okFoto").addEventListener("click", function () {
        canvas.getContext("2d").drawImage(video, 0, 0, 400, 300);
    });
}

$(document).ready(function(){
    var HOST = 'http://' + window.location.hostname;
    var URL = window.location.pathname.split('/');

    if( HOST == 'http://localhost'){
        SERVER = HOST + '/' + URL[1] + '/' + URL[2];
        URL = URL[3];
    }

  // Máscaras
  if($('.formFone').length)
        $('.formFone').inputmask('(99) 9999-9999[9]');

    if($('.formCPF').length)
        $('.formCPF').inputmask('999.999.999-99');

    if($('.formCEP').length)
        $('.formCEP').inputmask('99999-999');

    if($('.formDate').length)
        $('.formDate').inputmask('99/99/9999');

    if($('.formRG').length)
        $('.formRG').inputmask('[99999]9999999');

    //if($('.formDin').length)
        //$('.formDin').inputmask('R$ [999.999],99');

    // Camera
    $('#okFoto').click(function(e){
        $('#imagem-preview').show();

        $('input[name=foto]').attr('value', 'Imagem capturada com sucesso!');
        var imageData = canvas.toDataURL('image/png');
        document.getElementsByName("codImagem")[0].setAttribute("value", imageData)
    });

    if($('#canvas').length){
        $('#canvas').each(function(){
            var canvas = document.getElementById("canvas");
            var dataSrc = $(this).attr('src');
            var context = canvas.getContext('2d');
            var imageObj = new Image();

            imageObj.onload = function() {
              context.drawImage(imageObj, 0, 0);
            };
            imageObj.src = dataSrc;
        });
    }
    
    // Textarea de edição
    if($('textarea.editor'))
        $('textarea.editor').summernote({
            lang: 'pt-BR',
            //airMode: true
        });

    // Select2
    $('.select2').select2({
        placeholder: 'Selecione'
    });

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
