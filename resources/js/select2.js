/**
 * Select2
 */
require('select2/dist/js/select2.min.js')

$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap-5',
        tags: false,
        width: '100%',
        language:'pt-BR',
    })

    document.addEventListener('select2SelectOption', function (event) {
        // console.log('select2SelectOption '+ event.detail.name)
        $('[data-select2-id="select2-data-' + event.detail.name + '"]')
            .val(event.detail.value)
            .trigger('change')
    })

    function refreshSelectOptions(eventData, selectId) {
        const selectElement = $('#'+selectId); // Replace with appropriate selector
        const newData = eventData;

        // Get the Select2 instance
        const select2Instance = selectElement.data('select2');

        // Clear existing options
        selectElement.empty();

        // Add new options
        selectElement.append(
            new Option('SELECIONE', null, false, false)
        );
        selectElement.append(newData.map(option => {
            return new Option(option.name, option.value, false, false);
        }));

        // Trigger an update
        select2Instance.trigger('change');
    }

    document.addEventListener('select2ReloadOptions', function (event) {
        // console.log('select2ReloadOptions'+ event.detail.name)
        refreshSelectOptions(event.detail.data, event.detail.name);
    })

    document.addEventListener('select2Reload', function (event) {
        // console.log('select2Reload'+ event.detail.name)
        $('#div-'+event.detail.name)[0].classList.remove('d-none');
        $('#'+event.detail.name).select2({
            theme: 'bootstrap-5',
            tags: false,
            width: '100%',
        });
    })

    document.addEventListener('select2Destroy', function (event) {
        // console.log('select2Destroy'+ event.detail.name)
        $('#'+event.detail.name).select2('destroy');
        $('#div-'+event.detail.name)[0].classList.add('d-none');
    })

    document.addEventListener('select2Disable', function (event) {
        $('#'+event.detail.name).prop("disabled", true);
    })

    document.addEventListener('select2Enable', function (event) {
        $('#'+event.detail.name).prop("disabled", false);
    })

    document.addEventListener('select2SetReadOnly', function (event) {
        if (event.detail.value === true)
            $('#'+event.detail.name).attr("readonly", "readonly");
        else
            $('#'+event.detail.name).removeAttr('readonly');
    })

    $('.select2').on('change', function (e) {
        var data = e.target.value
        var name = e.target.name

        const livewireComponents = window.Livewire.all()
        livewireComponents.forEach((component) => {
            if (component.get(name) !== undefined) {
                component.set(name, data)
            }
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
