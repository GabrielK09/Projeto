<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFC-e</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container{
            width: 100%;
            margin: 0 auto;
            padding: 0;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert{
            padding:10px;
            margin-bottom:20px;
            border: 1px solid #f8d7da;
            border-radius:5px;
            background-color: #f8d7da;
            color: #721c24;
        }
        form{
            margin-bottom: 20px;
        }
        form input[type="search"]{
            padding: 10px;
            width:70%;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        form button{
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        .search{
        grid-column: 1 / -1;
        }

    </style>
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
            @if($produtos)
<<<<<<< HEAD
                
                    <div class="teste">
                        {{ $produtos->id }}

                    </div>

                        <div class="teste">
                            {{ $produtos->nome }}

                        </div>

                        <div class="teste">
                            {{ number_format($produtos->preco_venda, 2) }}
                            
                        </div>
        @else
            <p>Nenhum produto encontrado.</p>
        @endif
        <div class="total">
            <h2>Total da Venda: <span class="total">R$ {{ number_format($total, 2, ',', '.') }}</span></h2>
        </div>

=======
                <ul>
                    <li>
                        Código: {{ $produtos->id }} | {{ $produtos->nome }} - Preço: R$ {{ number_format($produtos->preco_venda, 2) }}
                    </li>
                </ul>
        @else
            <p>Nenhum produto encontrado.</p>
        @endif
        <div class="total">
            <h2>Total da Venda: <span class="total">R$ {{ number_format($total, 2, ',', '.') }}</span></h2>
        </div>

>>>>>>> f084749d7f5ea2f59dbdcf0acbade14f8884406e
        <form action="/finalizar-venda" method="POST">
            @csrf
            <button type="submit">Finalizar</button>
        </form>
    </main>
    </div>
</body>
</html>