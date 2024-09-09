<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/produto.css">
</head>
<body>
    <div class="container">
        @include('main.lateral_bar')
        <main class="scope">
            <a class="new_btn" target="_blank" href="produto/cadastro"><button>Cadastrar produto</button></a>
            @foreach ($produtos as $produto)
            <div class="produto" style="margin: 15px">
                <p>Produto: {{ $produto->nome }}</p>
                <p>Quantia: {{ $produto->qte }}</p>
                <p>Código de barras GTIN: {{ $produto->cod_gtin }}</p>
                <p>R$ {{ $produto->preco_venda }}</p>
                <p>CFOP: {{ $produto->cfop }}</p>
                <p>CSOSN/CST: {{ $produto->csosn }}</p>
                <p>NCM: {{ $produto->ncm }}</p>

                <a href=""><button>Editar produto</button></a>
            </div>
            @endforeach
        
        </main>
    </div>
</body>
</html>