import VMasker from 'vanilla-masker'
window.VMasker = VMasker

window.inputHandler = (masks, max, event) => {
    var c = event.target
    var v = c.value.replace(/\D/g, '')
    var m = c.value.length > max ? 1 : 0
    VMasker(c).unMask()
    VMasker(c).maskPattern(masks[m])
    c.value = VMasker.toPattern(v, masks[m])
}

import Alpine from 'alpinejs'
window.Alpine = Alpine
import intersect from '@alpinejs/intersect'

Alpine.plugin(intersect)
Alpine.start()

window.Swal = require('sweetalert2')


window.addEventListener('swal-checkout-failure', function (e) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        width: 500,
        icon: 'error',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        html:
            '<div class="row">' +
                '<div class="d-flex justify-content-center">' +
                    '<h3>'+e.detail.error+'</h3>'+
                '</div>'+
            '</div>'
    })
})

window.addEventListener('swal-checkout-success', function (e) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        width: 500,
        icon: 'success',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        html:
            '<div class="row">' +
                '<div class="d-flex justify-content-center">' +
                    '<h3>Checkout realizado</h3>'+
                '</div>'+
            '</div>'+
            '<hr class="my-1"/>'+
            '<div class="row">' +
                '<div class="col-4">' +
                    '<img class="w-100" src="'+e.detail.photo+'">' +
                '</div>' +
                '<div class="col-8 d-flex">' +
                    '<div class="align-self-center">' +
                        e.detail.name +
                    '</div>' +
                '</div>' +
            '</div>'
    })
})
window.addEventListener('swall-error', function (e){
    const options = e.detail
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: options.text,
    })
})
window.addEventListener('swal', function (e) {
    const options = e.detail

    Swal.fire({
        title: options.title,
        text: options.text,
        icon: 'warning',
        showConfirmButton: true,
        cancelButtonColor: '#E3352E',
        confirmButtonColor: '#38c172',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit(options.confirmEvent)

            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCancelButton: false,
                timer: 2000,
                icon: 'success',
                title: (options.action === 'delete' ? 'Removido' : 'Salvo') + ' com sucesso',
            })
        }
    })
})

window.addEventListener('show-modal', function (e) {
    $('#' + e.detail.target).modal('show')
})

window.addEventListener('hide-modal', (e) => {
    $('#' + e.detail.target).modal('hide')
})
