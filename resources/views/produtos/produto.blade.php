<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/produto.css">
</head>
<body>
    <div class="container">
        @include('main.sidebar')
        <main class="scope">

            <div class="header">
                <div id="painel">
                    <h1>Total de produtos: {{ count($produtos) }}</h1>
                    <h1>Produtos ativos: {{ count($ativos) }}</h1>
                    <h1>Produtos Inativos: {{ count($inativos) }}</h1>
                </div>
                <div class="btn_container">
                    <a class="cadastrarProduto" target="_blank" href="produto/cadastro">
                        <button class="btn cadastrarProduto">Cadastrar produto</button>
                    </a>
                </div>
                
            </div>

            @foreach ($produtos as $produto)
                <div class="produtos" style="margin: 15px">
                    <p>Produto: {{ $produto->nome }}</p>
                    <p>Quantia: {{ $produto->qte }}</p>
                    <p>Código de barras GTIN: {{ $produto->cod_gtin }}</p>
                    <p>R$ {{ $produto->preco_venda }}</p>
                    <p>CFOP: {{ $produto->cfop }}</p>
                    <p>CSOSN/CST: {{ $produto->csosn }}</p>
                    <p>NCM: {{ $produto->ncm }}</p>
                    <p>Ativo: {{ $produto->ativo === 1 ? "Ativo" : "Inativo" }}</p>

                    <a href="/produto/editar/{{ $produto->id }}"><button class="btn editarProduto">Editar produto</button></a>

                    @if ($produto->ativo === 1)
                    <form action="{{ route('produto.inativar', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST') <!-- Use PATCH se preferir o método PATCH -->
                        <button type="submit" class="btn inativar" onclick="return confirm('Você tem certeza que deseja inativar este produto?');">
                            Inativar produto
                        </button>
                    </form>
                    @else
                    <form action="{{ route('produto.ativar', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST') <!-- Use PATCH se preferir o método PATCH -->
                        <button type="submit" class="btn ativar" onclick="return confirm('Você tem certeza que deseja inativar este produto?');">
                            Ativar produto
                        </button>
                    </form>
                        
                    @endif

                </div>
            @endforeach
    
        </main>
    </div>
</body>
</html>