window.addEventListener('show-modal', function (e) {
    $('#' + e.detail.target).modal('show')
})

window.addEventListener('hide-modal', (e) => {
    $('#' + e.detail.target).modal('hide')
})
