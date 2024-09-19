<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo Produto</title>
    <link rel="stylesheet" href="/css/pessoas.css">
</head>
<body>
    <div class="scope">
        @include('main.sidebar')
        <div class="forms_show_de_bola">
            <form action="{{ route('pessoas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome_completo">Nome completo*</label>
                    <input type="text" name="nome_completo" id="nome_completo" value="{{ old('nome_completo') }}">

                    {{-- @error('nome')
                        <div class="text-danger">{{ $message }}</div> 

                    @enderror --}}
                </div>

                <div class="form-group">
                    <label for="tipo_pessoa">Tipo de cadastro*</label>
                    <input type="text" name="tipo_pessoa">
                    {{-- @error('qte')
                        <div class="text-danger">{{ $message }}</div>     

                    @enderror --}}
                </div>
            
                <div class="form-group">
                    <label for="cpf">CPF*</label>
                    <input type="text" name="cpf">
                    {{-- @error('cod_gtin')
                        <div class="text-danger">{{ $message }}</div>              
                    @enderror --}}
                </div>

                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento*</label>
                    <input type="text" name="data_nascimento" id="data_nascimento">
                    {{-- @error('preco_venda')
                        <div class="text-danger">{{ $message }}</div>              
                    @enderror --}}
                </div>

                <div class="form-group">
                    <label for="tipo_cadastro">Tipo de cadastro*</label>
                    <input type="text" name="tipo_cadastro">
                    {{-- @error('cfop')
                        <div class="text-danger">{{ $message }}</div>              
                    @enderror --}}
                </div>
                
                <button>Cadastrar</button>
                
            </form>
        </div>  
    </div>
</body>
</html>