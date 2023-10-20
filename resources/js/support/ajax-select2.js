window.formatVisitor = function (visitor) {
    if (visitor.loading) {
        return visitor.text
    }

    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar row'>" +
            "<img class='col-2' src='" +
            visitor.photo +
            "' />" +
            "<div class='select2-result-repository__meta col-10'>" +
            visitor.person.name +
            ' - ' +
            visitor.document.type +
            ': ' +
            visitor.document.number_maskered +
            ' - Entrada: ' +
            visitor.entranced_at_br_formatted +
            '</div>' +
            '</div>' +
            '</div>',
    )
    return $container
}

window.formatVisitorSelection = function (visitor) {
    if (visitor.id) {
        return (
            visitor.person.name +
            ' - ' +
            visitor.document.type +
            ': ' +
            visitor.document.number_maskered +
            ' - Entrada: ' +
            visitor.entranced_at_br_formatted
        )
    } else {
        return 'SELECIONE'
    }
}
