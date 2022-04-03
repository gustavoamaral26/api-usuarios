function buscarDadosAll() {
    fetch('http://localhost:8000/api/usuarios', {
        method: 'GET'
    })
        .then(function (response) { return response.json(); })
        .then(function (response) {
        response.dados.forEach(function (element) {
            var table = document.getElementById('table');
            table.innerHTML += "\n            <tr>\n                <td>".concat(element.email, "</td>\n                <td>").concat(element.senha, "</td>\n                <td><button class=\"input-group-Dtext btn btn-danger\" onclick='excluirUsuario(").concat(element.id, ")'>Excluir</button></td>\n            </tr>");
        });
    });
}
function excluirUsuario(id) {
    fetch('http://localhost:8000/api/usuario/' + id, {
        method: 'DELETE'
    })
        .then(function (response) { return response.json(); })
        .then(function (response) {
        alert(response.message);
        var table = document.getElementById('table');
        table.innerHTML = '';
        buscarDadosAll();
    });
}
function busca() {
    var str = document.getElementById('busca').value;
    if (str == '') {
        alert('O campo de pesquisa deve ser preenchido corretamete!!!');
    }
    else {
        fetch('http://localhost:8000/api/usuarios/busca/' + str, {
            method: 'GET'
        })
            .then(function (response) { return response.json(); })
            .then(function (response) {
            var table1 = document.getElementById('table');
            table1.innerHTML = '';
            response.dados.forEach(function (element) {
                var table = document.getElementById('table');
                table.innerHTML += "\n                <tr>\n                    <td>".concat(element.email, "</td>\n                    <td>").concat(element.senha, "</td>\n                    <td><button class=\"input-group-Dtext btn btn-danger\" onclick='excluirUsuario(").concat(element.id, ")'>Excluir</button></td>\n                </tr>");
            });
        });
    }
}
