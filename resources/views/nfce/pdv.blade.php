<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFC-e</title>
    <link rel="stylesheet" type="text/css" href="/css/nfce.css">
</head>
<body>

    <div class="container">
        @include('main.sidebar')

        <div class="Buscar">
            <form action="/pdv" method="GET">
                @csrf
                <input type="search" name="query" placeholder="Buscar item" value="{{ request('query') }}">
                <input type="hidden" name="total" value="{{ $total ?? 0 }}"> 
                <button type="submit">Buscar</button>
            </form>
        </div>

        @if(session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

        <div class="Grid">
            @if($produto)
                <div class="produto">
                    Código: {{ $produto->id }} | {{ $produto->nome }} - Preço: R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                </div>

            @endif
        </div>

        <div class="total">
            <h2>Total da Venda: <span class="total">R$ {{ number_format($total, 2, ',', '.') }}</span></h2>
        </div>

        <div class="valores">
            <form action=>
                <label for="acrescimo">Acréscimo:</label>
                <input type="search" name="acrescimo" placeholder="Inserir acréscimo" value="{{ request('acrescimo') }}">
                <label for="desconto">Desconto:</label>
                <input type="search" name="desconto" placeholder="Inserir desconto" value="{{ request('desconto') }}">
            </form>
        </div>

        <div class="formas" style="display: none">
            @include('nfce.finalizar')
        </div>
        
        <form action="/finalizar" method="POST">
            @csrf
            <button type="submit">Finalizar</button>
        </form>

    </main>
    </div>
</body>
</html>
