/**
 * Echo & Pusher
 */

import Echo from 'laravel-echo'

if (window.laravel.broadcast) {
    window.Pusher = require('pusher-js')
    // Pusher.logToConsole = true

    let echoConfig = {
        broadcaster: window.laravel.broadcast.driver,
        key: window.laravel.pusher.key,
        cluster: window.laravel.pusher.options.cluster,
        forceTLS: true
    }

    if (window.laravel.pusher.server === 'laravel-websockets') {
        echoConfig.wsHost = window.laravel.pusher.options.host
        echoConfig.wsPort = window.laravel.pusher.options.port
        echoConfig.disableStats = false
    }

    window.Echo = new Echo(echoConfig)
}
