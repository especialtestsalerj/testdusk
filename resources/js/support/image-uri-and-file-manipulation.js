window.isDataURI = function(str) {
    // Regular expression to match a Data URI
    const dataURIPattern = /^data:[\w\/\+]+;[\w=]+(,[\w\/\+;=]+)*$/;

    // Test the string against the pattern
    return dataURIPattern.test(str);
}

window.extractBase64Image = function (dataUrl) {
    const regex = /^data:.+\/(.+);base64,(.*)$/
    const match = dataUrl.match(regex)

    if (match && match.length === 3) {
        const mimeType = match[1]
        const base64Data = match[2]
        return base64Data
    }

    return dataUrl
}

window.base64ToFile = function (dataUrl, filename) {
    dataUrl = extractBase64Image(dataUrl)
    const byteCharacters = atob(dataUrl)
    const byteArrays = []

    for (let offset = 0; offset < byteCharacters.length; offset += 512) {
        const slice = byteCharacters.slice(offset, offset + 512)
        const byteNumbers = new Array(slice.length)

        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i)
        }

        const byteArray = new Uint8Array(byteNumbers)
        byteArrays.push(byteArray)
    }

    const blob = new Blob(byteArrays, { type: 'image/jpeg' })
    const file = new File([blob], filename, { type: 'image/jpeg', lastModified: new Date() })

    return file
}

window.urlToFile = async function(url, filename) {
    try {
        const response = await fetch(url);
        const blob = await response.blob();
        return new File([blob], filename, { type: 'image/jpeg' });
    } catch (error) {
        console.error('Error converting URL to File:', error);
        return null;
    }
}
