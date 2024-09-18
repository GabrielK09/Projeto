<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        form {
            margin: 20px auto;
            padding: 0px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .error {
            color: red;
            font-size: 0.875em;
        }
    </style>
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