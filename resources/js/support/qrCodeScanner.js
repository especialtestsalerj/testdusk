import _ from 'lodash';
window.$ = window.jQuery = require('jquery')

// To use Html5QrcodeScanner (more info below)
import { Html5QrcodeScanner, Html5QrcodeScanType } from 'html5-qrcode'
window.Html5QrcodeScanner = Html5QrcodeScanner

// To use Html5Qrcode (more info below)
import { Html5Qrcode } from 'html5-qrcode'
window.Html5Qrcode = Html5Qrcode

window.isProcessingQRCode = []

window.qrCodeScanned = function qrCodeScanned(decodedText, decodedResult){
    isProcessingQRCode[decodedText] = true
    // console.log(`Code matched = ${decodedText}`, decodedResult)

    var event = new CustomEvent('qrcodescanned', {
        bubbles: true,
        cancelable: true,
        detail: { decodedText: decodedText, decodedResult: decodedResult },
    });

    $('#reader')[0].dispatchEvent(event);

    setTimeout(()=>isProcessingQRCode[decodedText] = false, 3000)
}

function onScanSuccess(decodedText, decodedResult) {
    if(!isProcessingQRCode.hasOwnProperty(decodedText) || isProcessingQRCode[decodedText] == false) {
        window.qrCodeScanned(decodedText, decodedResult)
    }
}

function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
    // console.warn(`Code scan error = ${error}`)
}

let config = {
    fps: 10,
    qrbox: {width: 300, height: 300},
    rememberLastUsedCamera: true,
    // Only support camera scan type.
    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
};

let html5QrcodeScanner = new Html5QrcodeScanner(
    'reader',
    config,
    /* verbose= */ false,
)
html5QrcodeScanner.render(onScanSuccess, onScanFailure)
