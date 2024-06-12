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
            '<h3>' +
            e.detail.error +
            '</h3>' +
            '</div>' +
            '</div>',
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
            '<h3>Checkout realizado</h3>' +
            '</div>' +
            '</div>' +
            '<hr class="my-1"/>' +
            '<div class="row">' +
            '<div class="col-4">' +
            '<img class="w-100" src="' +
            e.detail.photo +
            '">' +
            '</div>' +
            '<div class="col-8 d-flex">' +
            '<div class="align-self-center">' +
            e.detail.name +
            '</div>' +
            '</div>' +
            '</div>',
    })
})
window.addEventListener('swall-error', function (e) {
    const options = e.detail
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        confirmButtonColor: '#38c172',
        text: options.text,
    })
})

window.addEventListener('swall-success', function (e) {
    const options = e.detail
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCancelButton: false,
        timer: 2000,
        icon: 'success',
        title: options.text,
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
        confirmButtonText: '<i class="fa fa-save"></i> Confirmar',
        cancelButtonText: '<i class="fa fa-ban"></i> Cancelar',
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

window.addEventListener('swal-confirmation', function (e) {
    const options = e.detail

    Swal.fire({
        title: options.title,
        text: options.text,
        icon: 'warning',
        showConfirmButton: true,
        cancelButtonColor: '#E3352E',
        confirmButtonColor: '#38c172',
        confirmButtonText: '<i class="fa fa-save"></i> Confirmar',
        cancelButtonText: '<i class="fa fa-ban"></i> Cancelar',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            if(options.route) {
                window.location = options.route;
            }
            if(options.event) {
                Livewire.emit(options.event)
            }
        }
    })
})

window.addEventListener('swal-input',function (e ){
    const option = e.detail

     Swal.fire({
        title: "select departure date",
        input: "date",
        didOpen: () => {
            const today = (new Date()).toISOString();
            Swal.getInput().min = today.split("T")[0];
        }
    });
    if (date) {
        Swal.fire("Departure date", date);
    }
})
