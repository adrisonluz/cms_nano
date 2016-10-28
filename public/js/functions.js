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