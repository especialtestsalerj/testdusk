function scannerTranslator() {
    const traducciones = [
        // Html5QrcodeStrings
        {
            original: 'QR code parse error, error =',
            traduccion: 'Erro ao analisar o código QR, erro =',
        },
        {
            original: 'Error getting userMedia, error =',
            traduccion: 'Erro ao obter userMedia, erro =',
        },
        {
            original:
                "The device doesn't support navigator.mediaDevices , only supported cameraIdOrConfig in this case is deviceId parameter (string).",
            traduccion:
                'O dispositivo não suporta navigator.mediaDevices, o único parâmetro suportado neste caso é o deviceId (string).',
        },
        {
            original: 'Camera streaming not supported by the browser.',
            traduccion: 'Transmissão da câmera não suportada pelo navegador.',
        },
        {
            original: 'Unable to query supported devices, unknown error.',
            traduccion: 'Não foi possível consultar os dispositivos suportados, erro desconhecido.',
        },
        {
            original: 'Camera access is only supported in secure context like https or localhost.',
            traduccion:
                'O acesso à câmera é suportado apenas em um contexto seguro, como https ou localhost.',
        },
        { original: 'Scanner paused', traduccion: 'Scanner em pausa' },

        // Html5QrcodeScannerStrings
        { original: 'Scanning', traduccion: 'Escaneando' },
        { original: 'Idle', traduccion: 'Inativo' },
        { original: 'Error', traduccion: 'Erro' },
        { original: 'Permission', traduccion: 'Permissão' },
        { original: 'No Cameras', traduccion: 'Sem câmeras' },
        { original: 'Last Match:', traduccion: 'Última correspondência:' },
        { original: 'Code Scanner', traduccion: 'Scanner de código' },
        { original: 'Request Camera Permissions', traduccion: 'Solicitar permissões de câmera' },
        {
            original: 'Requesting camera permissions...',
            traduccion: 'Solicitando permissões de câmera...',
        },
        { original: 'No camera found', traduccion: 'Nenhuma câmera encontrada' },
        { original: 'Stop Scanning', traduccion: 'Parar de escanear' },
        { original: 'Start Scanning', traduccion: 'Iniciar escaneamento' },
        { original: 'Switch On Torch', traduccion: 'Ligar lanterna' },
        { original: 'Switch Off Torch', traduccion: 'Desligar lanterna' },
        { original: 'Failed to turn on torch', traduccion: 'Falha ao ligar a lanterna' },
        { original: 'Failed to turn off torch', traduccion: 'Falha ao desligar a lanterna' },
        { original: 'Launching Camera...', traduccion: 'Iniciando câmera...' },
        { original: 'Scan an Image File', traduccion: 'Escanear um arquivo de imagem' },
        {
            original: 'Scan using camera directly',
            traduccion: 'Escanear diretamente usando a câmera',
        },
        { original: 'Select Camera', traduccion: 'Selecionar câmera' },
        { original: 'Choose Image', traduccion: 'Escolher imagem' },
        { original: 'Choose Another', traduccion: 'Escolher outra' },
        { original: 'No image choosen', traduccion: 'Nenhuma imagem escolhida' },
        { original: 'Anonymous Camera', traduccion: 'Câmera anônima' },
        { original: 'Or drop an image to scan', traduccion: 'Ou arraste uma imagem para escanear' },
        {
            original: 'Or drop an image to scan (other files not supported)',
            traduccion:
                'Ou arraste uma imagem para escanear (outros tipos de arquivo não suportados)',
        },
        { original: 'zoom', traduccion: 'zoom' },
        { original: 'Loading image...', traduccion: 'Carregando imagem...' },
        { original: 'Camera based scan', traduccion: 'Escanear com base na câmera' },
        { original: 'File based scan', traduccion: 'Escanear com base no arquivo' },

        // LibraryInfoStrings
        { original: 'Powered by ', traduccion: 'Desenvolvido por ' },
        { original: 'Report issues', traduccion: 'Reportar problemas' },

        // Others
        {
            original: 'NotAllowedError: Permission denied',
            traduccion: 'Erro de permissão: Acesso negado',
        },
    ]

    // Función para traducir un texto
    function traducirTexto(texto) {
        const traduccion = traducciones.find((t) => t.original === texto)
        return traduccion ? traduccion.traduccion : texto
    }

    // Función para traducir los nodos de texto
    function traducirNodosDeTexto(nodo) {
        if (nodo.nodeType === Node.TEXT_NODE) {
            nodo.textContent = traducirTexto(nodo.textContent)
        } else {
            for (let i = 0; i < nodo.childNodes.length; i++) {
                traducirNodosDeTexto(nodo.childNodes[i])
            }
        }
    }

    // Crear el MutationObserver
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach((nodo) => {
                    traducirNodosDeTexto(nodo)
                })
            }
        })
    })

    // Configurar y ejecutar el observer
    const config = { childList: true, subtree: true }
    observer.observe(document.body, config)

    // Traducir el contenido inicial
    traducirNodosDeTexto(document.body)
}

document.addEventListener('DOMContentLoaded', function () {
    // Utilizando la función scannerTranslator
    scannerTranslator(document.querySelector('#qr-reader'))
})
