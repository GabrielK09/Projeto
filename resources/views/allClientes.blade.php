<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/allPedidos.css">
    
</head>
<body>
    <h2>Todos os clientes</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($query as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->item }}</td>
                    <td>{{ $pedido->preview }}</td>
                    <td>{{ $pedido->status }}</td>
                    <td><a href="{{ url('pedido/' . $pedido->id) }}"><button class="detalhes">Mais detalhes</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>