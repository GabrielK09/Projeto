<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar</title>
    <link rel="stylesheet" type="text/css" href="/css/nfce.css">
</head>
<body>
    <div class="formaspagamento">
        <label for="ldinheiro">Dinheiro:</label>
        <input type="search" name="dinheiro" placeholder="Inserir" value="{{ request('dinheiro') }}">
        <label for="lpix">Pix:</label>
        <input type="search" name="pix" placeholder="Inserir" value="{{ request('pix') }}">
        <label for="ldebito">Cartão Débito</label>
        <input type="search" name="debito" placeholder="Inserir" value="{{ request('debito') }}">
        <label for="lcredito">Cartão Crédito</label>
        <input type="search" name="credito" placeholder="Inserir" value="{{ request('credito') }}">
    </div>
</body>
</html>
