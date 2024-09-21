function buscarClientes(query){
    if(query.length < 2){
        document.getElementById('resultado-clientes').style.display = 'none';
        return;
    }

    fetch('/clientes/buscar?query=${query}')
        .then(response => response.json())
        .then(data => {
            const clientesList = document.getElementById('clientes-list');
            clientesList.innerHTML = '';
            if (data.length > 0){
                data.forEach(cliente => {
                    const li = document.createElement('li');
                    li.textContent = cliente.nome;
                    li.onclick = () => selecionarCliente(cliente);
                    clientesList.appendChild(li);
                });
                document.getElementById('resultado-clientes').style.display = 'block';
            } else {
                document.getElementById('resultado-clientes').style.display = 'none';
            }
        });
}

function selecionarCliente(cliente){
    document.getElementById('cliente').value = cliente.none;
    document.getElementById('resultado-clientes').style.display = 'none';
}