// To use Html5QrcodeScanner (more info below)
import { Html5QrcodeScanner } from 'html5-qrcode'
window.Html5QrcodeScanner = Html5QrcodeScanner

// To use Html5Qrcode (more info below)
import { Html5Qrcode } from 'html5-qrcode'
window.Html5Qrcode = Html5Qrcode

function onScanSuccess(decodedText, decodedResult) {
    // handle the scanned code as you like, for example:
    _.debounce(() => {
        console.log(`Code matched = ${decodedText}`, decodedResult)
    })

    console.log(`Code matched = ${decodedText}`, decodedResult)
}

function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
    // console.warn(`Code scan error = ${error}`)
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    'reader',
    { fps: 10, qrbox: { width: 250, height: 250 } },
    /* verbose= */ false,
)
html5QrcodeScanner.render(onScanSuccess, onScanFailure)
