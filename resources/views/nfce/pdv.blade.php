<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFC-e</title>
    <link rel="stylesheet" type="text/css" href="/css/nfce.css">
    <script src="/js/clientes.js"></script>
</head>
<body>

    <div class="container">
        @include('main.sidebar')

        {{-- Buscar produtos --}}
        <form action="{{ route('pdv') }}" method="GET" id="search-form myForm">
            @csrf
            <input type="text" name="query" placeholder="Buscar produto" value="{{ old('query', request('query')) }}">
            <button type="submit">Buscar</button>
        </form>



        {{-- Exibir produtos --}}
        <div class="Grid">
            @if(isset($query) && isset($produto))
                <div class="produto">
                    Código: {{ $produto->id }} | Nome: {{ $produto->nome }}  
                </div>
                <div class="precoproduto">
                    Preço: R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                    <input type="hidden" class="preco" value="{{ $produto->preco_venda }}">
                </div>
                <form action="{{ route('pdv') }}" method="POST">
                    @csrf
                    <input type="hidden" name="acrescimo" value="{{ request('acrescimo', 0) }}">
                    <input type="hidden" name="desconto" value="{{ request('desconto', 0) }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="query" value="{{ request('query') }}">
                    <button type="submit">Adicionar Produto</button>
                </form>
            @else
                <p>Nenhum produto encontrado.</p>
            @endif
        </div>

        @if(session('produtos'))
            <h3>Produtos Selecionados:</h3>
            <ul>
                @foreach(session('produtos') as $produto)
                    <li>{{ $produto->nome }} - R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Todos os valores --}}
        <form action="{{ route('pdv') }}" method="GET">
            @csrf
            <label for="acrescimo">Acréscimo:</label>
            <input type="number" name="acrescimo" placeholder="Inserir acréscimo" value="{{ request('acrescimo', 0) }}" step="0.01">
            
            <label for="desconto">Desconto:</label>
            <input type="number" name="desconto" placeholder="Inserir desconto" value="{{ request('desconto', 0) }}" step="0.01">
            
            <input type="hidden" name="query" value="{{ request('query') }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <h2>Total da Venda: <span id="total-display">R$ {{ number_format($total, 2, ',', '.') }}</span></h2>

            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            
            <button type="submit">Atualizar Total</button>
        </form>



        {{-- Cancelar venda --}}
        <form action="{{ route('pdv.cancelar')}}" method="POST" style="display: inline">
            @csrf
            <button type="submit" class="btnCancel">Cancelar Venda</button>
        </form>

        {{-- Selecionar cliente --}}
        <div class="clientes">
            <form action="{{ route('pdv2') }}" method="GET" id="search-form myForm">
                @csrf
                <input type="text" name="query_cliente" placeholder="Buscar produto" value="{{ old('query', request('query')) }}">
                <button type="submit">Buscar</button>
        
                @if(session('cliente') )
                    <ul>
                        @foreach(session('cliente') as $cliente)
                            <li>{{ $cliente->id }} - {{ $cliente->nome_completo }}</li> <!-- Adjust based on available fields -->
                        @endforeach
                    </ul>
                @else
                    <p>Nenhum cliente encontrado.</p>
                @endif
            </form>
        </div>
          
    </div>
</body>
</html>
</html>