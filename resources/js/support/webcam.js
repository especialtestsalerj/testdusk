import Webcam from 'webcamjs'
window.Webcam = Webcam
window.Swal = require('sweetalert2')

Webcam.set({
    width: 380,
    height: 290,
    dest_width: 640,
    dest_height: 480,
    jpeg_quality: 90,
    force_flash: false,
    flip_horiz: true,
})

window.take_snapshot = function () {
    window.Webcam.snap(function (data_uri) {
        window.update_photo(data_uri)
    })
}

window.remove_snapshot = function () {
    const fileInput = document.querySelector('input[type=file]')
    window.removeFilesFromInput(fileInput);
    window.dispatchAttachEvents(fileInput);
}

window.update_photo = function (data_uri) {
    if (data_uri && data_uri !== '/img/no-photo.svg') {
        const myFile = window.isDataURI(data_uri) ?
            base64ToFile(data_uri, 'webcam-picture.jpg')
            : window.urlToFile(data_uri, 'webcam-picture.jpg')

        if(window.isPromise(myFile)) {
            myFile.then((file) => window.attachPhoto(file))
        }else{
            window.attachPhoto(myFile)
        }
    }
}

window.removeFilesFromInput = function(fileInput) {
    const dataTransfer = new DataTransfer()
    fileInput.files = dataTransfer.files
}

window.attachFileIntoPhotoInput = function(myFile, fileInput) {
    const dataTransfer = new DataTransfer()
    dataTransfer.items.add(myFile)
    fileInput.files = dataTransfer.files
}

window.dispatchAttachEvents = function(fileInput) {
    var inputEvent = new Event('input')
    fileInput.dispatchEvent(inputEvent)
    var changeEvent = new Event('change')
    fileInput.dispatchEvent(changeEvent)
}

window.attachPhoto = function(myFile) {
    const fileInput = document.querySelector('input[type=file]')
    window.attachFileIntoPhotoInput(myFile, fileInput);
    window.dispatchAttachEvents(fileInput);
}

window.clearCanvas = function (id){
    const element = document.getElementById(id)
    var ctx = element.getContext('2d')
    ctx.fillStyle = 'white'
    ctx.fillRect(0, 0, element.width, element.height)
}

Webcam.on('error', function(err) {
    Swal.fire({
        position: 'top',
        icon: 'error',
        title: 'Nenhuma câmera foi encontrada',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        timer: 1500,
    })
});
