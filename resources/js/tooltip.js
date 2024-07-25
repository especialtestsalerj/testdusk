import Tooltip from 'bootstrap/js/dist/tooltip';

document.addEventListener("DOMContentLoaded", function () {
    initializeTooltips();

    Livewire.hook('element.initialized', (el, component) => {
        initializeTooltips();
    });
});

function initializeTooltips() {
    // Seleciona todos os elementos que precisam de tooltip e que ainda não foram inicializados
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]:not([data-tooltip-initialized])'));

    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        // Inicializa o tooltip
        new Tooltip(tooltipTriggerEl);

        // Marca o elemento como inicializado
        tooltipTriggerEl.setAttribute('data-tooltip-initialized', 'true');
    });
}

