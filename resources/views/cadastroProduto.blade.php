<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo Produto</title>
  
</head>
<body>
    @include('main.lateral_bar')
    <form action=" {{ route ('produto.store') }}" method="POST">
        @csrf
        <label for="nome">Nome*</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="qte">Quantia*</label>
        <input type="text" name="qte" id="qte" required>
    
        <label for="cod_gtin">Código de Barras GTIN<label>
        <input type="text" name="cod_gtin" id="cod_gtin" required>

        <label for="preco_venda">Preco venda*</label>
        <input type="text" name="preco_venda" id="preco_venda" required>

        <label for="cfop">CFOP*</label>
        <input type="text" name="cfop" id="cfop" required>
        
        <label for="csosn">CSOSN*</label>
        <input type="text" name="csosn" id="csosn" required>
        
        <label for="ncm">NCM*</label>
        <input type="text" name="ncm" id="ncm" required>

        <button>Cadastrar</button>
    </form>
    
</body>
</html>