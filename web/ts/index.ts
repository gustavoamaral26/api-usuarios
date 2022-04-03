function buscarDadosAll(){
    fetch('http://localhost:8000/api/usuarios',{
        method: 'GET'
    })
    .then(response => response.json())
    .then((response) => {
        response.dados.forEach((element: { email: string; senha: string; id: bigint }) => {
            const table = document.getElementById('table') as HTMLElement;
            table.innerHTML += `
            <tr>
                <td>${element.email}</td>
                <td>${element.senha}</td>
                <td><button class="input-group-Dtext btn btn-danger" onclick='excluirUsuario(${element.id})'>Excluir</button></td>
            </tr>`
        });     
    });
}

function excluirUsuario(id: bigint){
    fetch('http://localhost:8000/api/usuario/'+id,{
        method: 'DELETE'
    })
    .then(response => response.json())
    .then((response) => {
        alert(response.message);
        const table = document.getElementById('table') as HTMLElement;
        table.innerHTML = ''; 
        buscarDadosAll();
    });
}

function busca(){
    const str = (<HTMLSelectElement>document.getElementById('busca')).value;
    if(str == ''){
        alert('O campo de pesquisa deve ser preenchido corretamete!!!');
    }else{
        fetch('http://localhost:8000/api/usuarios/busca/'+str,{
        method: 'GET'
        })
        .then(response => response.json())
        .then((response) => {
            const table1 = document.getElementById('table') as HTMLElement;
            table1.innerHTML = '';
            response.dados.forEach((element: { email: string; senha: string; id: bigint }) => {
                const table = document.getElementById('table') as HTMLElement;
                table.innerHTML += `
                <tr>
                    <td>${element.email}</td>
                    <td>${element.senha}</td>
                    <td><button class="input-group-Dtext btn btn-danger" onclick='excluirUsuario(${element.id})'>Excluir</button></td>
                </tr>`
            });    
        });
    }
}