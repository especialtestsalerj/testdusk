window.$ = window.jQuery = require('jquery')

require('./bootstrap')

/**
 * Select2
 */
require('select2/dist/js/select2.min.js')

$(document).ready(function () {
<<<<<<< HEAD
<<<<<<< HEAD
    $('.select2').select2({
        theme: 'bootstrap-5',
        tags: false,
        width: '100%',
    })

    document.addEventListener('select2SelectOption', function (event) {
        $('[data-select2-id="select2-data-' + event.detail.name + '"]')
            .val(event.detail.value)
            .trigger('change')
    })
=======

=======
>>>>>>> 6c89713 (Select2 support)
    $('.select2').select2({
        theme: 'bootstrap-5',
        tags: false,
        width: '100%',
    })

<<<<<<< HEAD
    document.addEventListener('select2SelectOption', function(event){
        $('[data-select2-id="select2-data-'+event.detail.name+'"]').val(event.detail.value).trigger('change')
    });
>>>>>>> db70f62 (Select2 support)
=======
    document.addEventListener('select2SelectOption', function (event) {
        $('[data-select2-id="select2-data-' + event.detail.name + '"]')
            .val(event.detail.value)
            .trigger('change')
    })
>>>>>>> 6c89713 (Select2 support)

    $('.select2').on('change', function (e) {
        var data = e.target.value
        var name = e.target.name

<<<<<<< HEAD
<<<<<<< HEAD
        const livewireComponents = window.Livewire.all()
        livewireComponents.forEach((component) => {
            if (component.get(name) !== undefined) {
                component.set(name, data)
            }
        })
    })
})
=======
        // console.log($('.select2[name='+name+']')[0].select2({
        //     theme: 'bootstrap-5',
        //     tags: false,
        //     width: '100%',
        // }))

        // var element = $('.select2[name="'+name+'"]');

        // element.select2({
        //     theme: 'bootstrap-5',
        //     tags: false,
        //     width: '100%',
        // })

        // console.log(window.Livewire.all())
        // console.log('searching for '+name)
        // console.log(window.Livewire.all())

        const livewireComponents = window.Livewire.all()
        livewireComponents.forEach((component)=>{
            // console.log(component.get('componentId'))
            // console.log(component.get('selected'))

            // console.log('component get = '+component.get(name))

            if(component.get(name) !== undefined){
                    // console.log('found '+name+' in '+component.get('componentId')+' as '+component.get(name) )

                    // console.log('name = '+name)

                    component.set(name, data)
                    // console.log($('.select2[name="'+name+'"]')[0])


                    // $('.select2[name="'+name+'"]').select2({
                    //     theme: 'bootstrap-5',
                    //     tags: false,
                    //     width: '100%',
                    // });
                    //


                }

        });
    });

});
>>>>>>> db70f62 (Select2 support)
=======
        const livewireComponents = window.Livewire.all()
        livewireComponents.forEach((component) => {
            if (component.get(name) !== undefined) {
                component.set(name, data)
            }
        })
    })
})
>>>>>>> 6c89713 (Select2 support)

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

import * as CropperJs from 'cropperjs'
window.Cropper = CropperJs

window.remove_snapshot = function () {
    window.Webcam.snap(function (data_uri) {
        document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '"/>'
    })
}

import 'cropperjs/dist/cropper.css'
window.Cropper = require('cropperjs')

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

require('./support/broadcast')
