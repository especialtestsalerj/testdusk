window.take_snapshot = function () {
    window.Webcam.snap(function (data_uri) {
        window.update_photo(data_uri)
    })
}

window.update_photo = function (data_uri) {
    if (data_uri) {
        const fileInput = document.querySelector('input[type=file]')
        const myFile = base64ToFile(data_uri, 'webcam-picture.jpg')

        // Now let's create a DataTransfer to get a FileList
        const dataTransfer = new DataTransfer()
        dataTransfer.items.add(myFile)
        fileInput.files = dataTransfer.files

        var inputEvent = new Event('input')
        fileInput.dispatchEvent(inputEvent)
        var changeEvent = new Event('change')
        fileInput.dispatchEvent(changeEvent)
    }
}
