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
    $('#btnNivel').click(function(e){
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
    $('.nivelDelete').click(function(e){
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
