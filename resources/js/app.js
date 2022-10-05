require('./bootstrap')

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


// core version + navigation, pagination modules:
import Swiper, { Navigation } from 'swiper';

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

});

