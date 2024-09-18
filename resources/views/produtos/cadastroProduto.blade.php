<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo Produto</title>
    <link rel="stylesheet" type="text/css" href="/css/cadastroproduto.css">
</head>
<body>
    <div class="scope">
        @include('main.sidebar')
        <form action="{{ route('produto.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome*</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}">
                @error('nome')
                    <div class="text-danger">{{ $message }}</div> 

                @enderror
            </div>

            <div class="form-group">
                <label for="qte">Quantia*</label>
                <input type="text" name="qte" id="qte" value="{{ old('qte') }}">
                @error('qte')
                    <div class="text-danger">{{ $message }}</div>     

                @enderror
            </div>
        
            <div class="form-group">
                <label for="cod_gtin">Código de Barras GTIN</label>
                <input type="text" name="cod_gtin" id="cod_gtin" value="{{ old('cod_gtin') }}">
                @error('cod_gtin')
                    <div class="text-danger">{{ $message }}</div>              
                @enderror
            </div>

            <div class="form-group">
                <label for="preco_venda">Preco venda*</label>
                <input type="text" name="preco_venda" id="preco_venda" value="{{ old('preco_venda') }}">
                @error('preco_venda')
                    <div class="text-danger">{{ $message }}</div>              
                @enderror
            </div>

            <div class="form-group">
                <label for="cfop">CFOP*</label>
                <input type="text" name="cfop" id="cfop" value="{{ old('cfop') }}">
                @error('cfop')
                    <div class="text-danger">{{ $message }}</div>              
                @enderror
            </div>
            
            <div class="form-group">
                <label for="csosn">CSOSN*</label>
                <input type="text" name="csosn" id="csosn" value="{{ old('csosn') }}">
                @error('csosn')
                    <div class="text-danger">{{ $message }}</div>              
                @enderror
            </div>
            
            <div class="form-group">
                <label for="ncm">NCM*</label>
                <input type="text" name="ncm" id="ncm" value="{{ old('ncm') }}">
                @error('ncm')
                    <div class="text-danger">{{ $message }}</div>              
                @enderror
            </div>

            <button>Cadastrar</button>
            
        </form>
    </div>
</body>
</html>