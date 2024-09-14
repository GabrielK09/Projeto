<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Busca</title>
</head>
<body>
    <h1>Resultados da Busca para "{{ $query }}"</h1>
    
    @if($results->isEmpty())
        <p>Nenhum produto encontrado.</p>
    @else
        <ul>
            @foreach($results as $product)
                <li>
                    <strong>{{ $product->name }}</strong><br>
                    {{ $product->description }}<br>
                    Preço: R$ {{ number_format($product->price, 2, ',', '.') }}
                </li>
            @endforeach
        </ul>
    @endif
    
    <a href="{{ url('/search') }}">Voltar</a>
</body>
</html>
