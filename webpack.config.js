const mix = require('laravel-mix');
const path = require('path')


mix.js('resources/js/app.js', 'public/js/bootstrap/app.js')
    .js('resources/js/app-tailwind.js', 'public/js/tailwind/app-tailwind.js');

mix.sass('resources/sass/app-tailwind.scss', 'public/css/tailwind/'); // creates 'dist/forum.css'

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
}

