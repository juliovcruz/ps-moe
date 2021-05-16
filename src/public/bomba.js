$(document).ready(function() {
    $.ajax({
        'url': "http://projeto/Empregador/ObtenhaTodos",
        'method': "GET",
        'contentType': 'application/json'
    }).done(function(data) {
        $('#example').dataTable({
            "aaData": data,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nomeDoResponsavel"
                },
                {
                    "data": "nomeDaEmpresa"
                },
                {
                    "data": "descricao"
                },
                {
                    "data": "produtos"
                },
                {
                    "data": "email"
                }
            ]
        })
    })
});