const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/alpine.js', 'public/js')
    .js('resources/js/app-tailwind.js', 'public/js/tailwind/app-tailwind.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/app-tailwind.scss', 'public/css/tailwind/')
    .options({
        postCss: [require('tailwindcss')],
    })
    .webpackConfig(require('./webpack.config'))
    .version();
