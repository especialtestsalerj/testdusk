/**
 * Select2
 */
require('select2/dist/js/select2.min.js')
import './support/ajax-select2'

const defaultConfig = {
    theme: 'bootstrap-5',
    width: '100%',
    language: 'pt-BR',
}

window.getSelect2OptionsForElement = (element) => {
    var dropdownParent = element.getAttribute('dropdown-parent')
    var json = { ...defaultConfig, tags: !!element.classList.contains('select2-tags') }

    if (dropdownParent) {
        json.dropdownParent = $('#' + dropdownParent)
    }

    return json
}

window.initCustomSelect2 = () => {
    $('.open-visitors-select2').select2({
        theme: 'bootstrap-5',
        width: '100%',
        language: 'pt-BR',
        ajax: {
            url: window.laravel.app.app_url + '/api/visitors/open',
            dataType: 'json',
            delay: 250,
            headers: {
                Authorization: `Bearer ${window.laravel.accessToken}`,
            },
            data: function (params) {
                return {
                    q: params.term, // search term
                    building_id: window.laravel.session.currentBuilding,
                    page: params.page,
                }
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1

                return {
                    results: data,
                    pagination: {
                        more: params.page * 30 < data.total_count,
                    },
                }
            },
            cache: true,
        },
        minimumInputLength: 1,
        templateResult: formatVisitor,
        templateSelection: formatVisitorSelection,
    })

    $('.open-visitors-select2').on('change', function (e) {
        var data = e.target.value
        var name = e.target.name

        window.updateLivewireField(data, name)
    })
}

window.updateLivewireField = function (data, name) {
    const livewireComponents = window.Livewire.all()
    livewireComponents.forEach((component) => {
        if (component.get(name) !== undefined) {
            component.set(name, data)
        }
    })
}

window.initSelect2 = () => {
    $('.select2').each(function (key, value) {
        $(this).select2(window.getSelect2OptionsForElement(value))
    })

    window.initCustomSelect2()
}

$(document).ready(function () {
    window.initSelect2()

    document.addEventListener('select2SelectOption', function (event) {
        $('[data-select2-id="select2-data-' + event.detail.name + '"]')
            .val(event.detail.value)
            .trigger('change')
    })

    function refreshSelectOptions(eventData, selectId) {
        const selectElement = $('#' + selectId) // Replace with appropriate selector
        const newData = eventData

        // Get the Select2 instance
        const select2Instance = selectElement.data('select2')

        //Capturar o item SELECIONE do componente quando houver, limpar e recolocá-lo
        var itemSelecione = ''

        if (selectElement[0].length > 0) {
            if (selectElement[0][0].text === 'SELECIONE') {
                itemSelecione = selectElement[0][0]
            }
            selectElement.empty()

            if (itemSelecione !== '') {
                selectElement.append(itemSelecione)
            }
        }

        // Add new options
        //selectElement.append(new Option('SELECIONE', null, false, false))
        selectElement.append(
            newData.map((option) => {
                return new Option(option.name, option.value, false, false)
            }),
        )

        // Trigger an update
        select2Instance.trigger('change')
    }

    document.addEventListener('select2ReloadOptions', function (event) {
        // console.log('select2ReloadOptions'+ event.detail.name)
        refreshSelectOptions(event.detail.data, event.detail.name)
    })

    document.addEventListener('select2Reload', function (event) {
        // console.log('select2Reload'+ event.detail.name)
        $('#div-' + event.detail.name)[0].classList.remove('d-none')

        const selector = $('#' + event.detail.name)
        const options = window.getSelect2OptionsForElement(selector[0])

        selector.select2(options)
    })

    document.addEventListener('select2Destroy', function (event) {
        // console.log('select2Destroy'+ event.detail.name)
        $('#' + event.detail.name).select2('destroy')
        $('#div-' + event.detail.name)[0].classList.add('d-none')
    })

    document.addEventListener('select2Disable', function (event) {
        $('#' + event.detail.name).prop('disabled', true)
    })

    document.addEventListener('select2Enable', function (event) {
        $('#' + event.detail.name).prop('disabled', false)
    })

    document.addEventListener('select2SetReadOnly', function (event) {
        if (event.detail.value === true) $('#' + event.detail.name).attr('readonly', 'readonly')
        else $('#' + event.detail.name).removeAttr('readonly')
    })

    $('.select2').on('change', function (e) {
        var data = e.target.value
        var name = e.target.name

        window.updateLivewireField(data, name)
    })
})

$(document).on('select2:open', (e) => {
    const selectId = e.target.id

    $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(
        function (key, value) {
            value.focus()
        },
    )
})

$.fn.select2.amd.define('select2/i18n/pt-BR', [], require('select2/src/js/select2/i18n/pt-BR'))
