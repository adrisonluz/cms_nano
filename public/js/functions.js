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
