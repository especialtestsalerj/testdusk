import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './storage/framework/views/*.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"

    ],
    theme: {
        extend: {


            colors: {
                'theme-color': '#164770',
                'theme-color-2': '#4596DA',

                brand: {
                    5: '#FDFEFF',
                    15: '#ECF6FF',
                    25: '#EFF6FC',
                    50: '#E1EEF9',
                    100: '#C5DEF3',
                    200: '#9AC6EB',
                    300: '#70AEE2',
                    400: '#4596DA',
                    500: '#277DC5',
                    600: '#164770',
                    650: '#143E62',
                    700: '#113553',
                    800: '#0E2C45',
                    900: '#0B2337',
                    950: '#081A29',
                    975: '#05111B',
                }
            },


            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            fontWeight: {
                thin: '100',
                hairline: '100',
                extralight: '200',
                light: '300',
                normal: '400',
                medium: '500',
                semibold: '600',
                bold: '700',
                extrabold: '800',
                'extra-bold': '800',
                black: '900',
            },

            height: {
                '128': '32rem',
                '132': '33rem',
                '136': '34rem',
                '140': '35rem',
                '144': '36rem',
                '148': '37rem',
                '152': '38rem',
                '156': '39rem',
                '160': '40rem',
                '164': '41rem',
                '168': '42rem',
                '172': '43rem',
                '176': '44rem',
                '180': '45rem',
                '184': '46rem',
                '188': '47rem',
                '192': '48rem',
                '196': '49rem',
                '200': '50rem',
                '204': '51rem',
                '208': '52rem',
                '212': '53rem',
                '216': '54rem',
                '220': '55rem',
                '224': '56rem',
                '228': '57rem',
                '232': '58rem',
                '236': '59rem',
                '240': '60rem',
                '244': '61rem',
                '248': '62rem',
                '252': '63rem',
                '256': '64rem',
                '260': '65rem',
                '264': '66rem',
                '268': '67rem',
                '272': '68rem',
                '276': '69rem',
                '280': '70rem',
                '284': '71rem',
                '288': '72rem',
                '292': '73rem',
                '296': '74rem',
                '300': '75rem',
            },
        },
    },
    plugins: [forms, typography, require('flowbite/plugin')],
}

