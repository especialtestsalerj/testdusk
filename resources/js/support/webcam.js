window.take_snapshot = function () {
    window.Webcam.snap(function (data_uri) {
        window.update_photo(data_uri)
    })
}

window.remove_snapshot = function () {
        const fileInput = document.querySelector('input[type=file]')

        console.log('remove_snapshot')

        const dataTransfer = new DataTransfer()
        fileInput.files = dataTransfer.files

        var inputEvent = new Event('input')
        fileInput.dispatchEvent(inputEvent)
        var changeEvent = new Event('change')
        fileInput.dispatchEvent(changeEvent)
}

window.attachPhoto = function(myFile) {
        const dataTransfer = new DataTransfer()
        const fileInput = document.querySelector('input[type=file]')

        dataTransfer.items.add(myFile)
        fileInput.files = dataTransfer.files

        var inputEvent = new Event('input')
        fileInput.dispatchEvent(inputEvent)
        var changeEvent = new Event('change')
        fileInput.dispatchEvent(changeEvent)
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
