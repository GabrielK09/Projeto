<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/idPedido.css">

</head>
<body>
    <h2>Serviço: {{ $pedido->preview }}</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Modelo</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->item }}</td>
                    <td>{{ $pedido->modelo }}</td>
                    <td>{{ $pedido->descricao }}</td>

                </tr>
        </tbody>
    </table>

    <section>
        <h2>Técnico responsável: {{ $pedido->tecnico }}</h1>
    </section>

</body>
</html>