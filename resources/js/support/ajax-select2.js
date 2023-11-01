window.formatVisitor = function (visitor) {
    if (visitor.loading) {
        return visitor.text
    }

    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar row'>" +
            "<img class='col-1' src='" +
            visitor.photo +
            "' />" +
            "<div class=\"select2-result-repository__meta col-10 pt-3\">\n" +
        "<div class=\"fw-bold fs-5 \">"+ visitor.person.name + "</div>\n" +
        "<div>"+visitor.document.type +
        ': ' +
        visitor.document.number_maskered+"</div>\n" +
        "<div> Entrada: <span class='fw-bold'>"+ visitor.entranced_at_br_formatted +"</span>  </div>\n" +
        "</div>" +
            '</div>' +
            '</div>',
    )
    return $container
}

window.formatVisitorSelection = function (visitor) {
    if(visitor.hasOwnProperty('selected') && visitor.selected && visitor.hasOwnProperty('text')){
        visitor = JSON.parse(visitor.text)
    }

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
