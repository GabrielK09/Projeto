<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produto</title>
    <link rel="stylesheet" href="css/produto.css">
</head>
<body>
    <div class="container">
        @include('main.sidebar')
        <main class="scope">

            <div class="header">
                <div id="painel">
                    <h1>Itens ativos: </h1>
                    <h1>Itens Inativos: </h1>
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

                    <a href="/produto/editar/{{ $produto->id }}"><button>Editar produto</button></a>
                </div>
            @endforeach
    
        </main>
    </div>
</body>
</html>