window.$ = window.jQuery = require('jquery')

require('./bootstrap')

/**
 * Select2
 */
require('select2/dist/js/select2.min.js')

$(() => {
    // jshint ignore:line
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap-5',
            tags: false,
            width: '100%',
        })

        $('.select2-tag').select2({
            theme: 'bootstrap-5',
            tags: true,
            width: '100%',
        })
    })
})

$(document).on('select2:open', (e) => {
    const selectId = e.target.id

    $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function (
        key,
        value,
    ) {
        value.focus()
    })
})

// core version + navigation, pagination modules:
import Swiper, { Navigation } from 'swiper'

// init Swiper:
const swiper = new Swiper('.swiper', {
    modules: [Navigation],

    // Optional parameters
    direction: 'horizontal',
    loop: false,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
})

import Webcam from 'webcamjs'
window.Webcam = Webcam

import * as CropperJs from "cropperjs"
window.Cropper = CropperJs

window.remove_snapshot = function() {
    window.Webcam.snap( function(data_uri) {
        document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
    } );
}

import 'cropperjs/dist/cropper.css'
window.Cropper = require('cropperjs')


window.extractBase64Image = function(dataUrl) {
    const regex = /^data:.+\/(.+);base64,(.*)$/;
    const match = dataUrl.match(regex);

    if (match && match.length === 3) {
        const mimeType = match[1];
        const base64Data = match[2];
        return base64Data;
    }

    return dataUrl;
}

window.base64ToFile = function(dataUrl, filename) {
    dataUrl = extractBase64Image(dataUrl);
    const byteCharacters = atob(dataUrl);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += 512) {
        const slice = byteCharacters.slice(offset, offset + 512);
        const byteNumbers = new Array(slice.length);

        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        const byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }

    const blob = new Blob(byteArrays, { type: 'image/jpeg' });
    const file = new File([blob], filename, { type: 'image/jpeg', lastModified: new Date(), });

    return file;
}

require('./support/broadcast')
