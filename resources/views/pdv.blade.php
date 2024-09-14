<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDV Mobile</title>
</head>
<body>
    @include('main.sidebar')
    <form action="/pdv" method="GET">
        @csrf
        <input type="search" name="query" placeholder="Buscar item" value="{{ request('query') }}">
        <input type="hidden" name="total" value="{{ $total ?? 0 }}"> 
        <button type="submit">Buscar</button>

    </form>

    @if(session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif


    @if($produtos)
        <h2>Produto Encontrado:</h2>
        <ul>
            <li>Código: {{ $produtos->id }} | {{ $produtos->nome }} - Preço: R$ {{ number_format($produtos->preco_venda, 2) }}</li>
            
        </ul>
    @else
        <p>Nenhum produto encontrado.</p>
    @endif

    <h2>Total da Venda: R$ {{ number_format($total, 2, ',', '.') }}</h2>

</body>
</html>
