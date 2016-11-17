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
});
