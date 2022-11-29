require('./bootstrap')

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

window.$ = window.jQuery = require('jquery')

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
