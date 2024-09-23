<div class="scope">
    @include('main.sidebar')
    <div class="forms_show_de_bola">
        <form action="{{ url('/cliente/' . $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="nome_completo">Nome completo*</label>
                    <input type="text" name="nome_completo" value="{{ $cliente->nome_completo }}">

                    {{-- @error('nome')
                        <div class="text-danger">{{ $message }}</div> 

                    @enderror --}}
                </div>

                <div class="form-group">
                    <label for="tipo_pessoa">Tipo de cadastro*</label>
                    <input type="text" name="tipo_pessoa" value="{{ $cliente->tipo_pessoa }}">
                    {{-- @error('qte')
                        <div class="text-danger">{{ $message }}</div>     

                    @enderror --}}
                </div>
            
                <div class="form-group">
                    <label for="cpf">CPF*</label>
                    <input type="text" name="cpf" value="{{ $cliente->cpf }}">
                    {{-- @error('cod_gtin')
                        <div class="text-danger">{{ $message }}</div>              
                    @enderror --}}
                </div>

                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento*</label>
                    <input type="text" name="data_nascimento" value=" {{ $cliente->data_nascimento}} ">
                    {{-- @error('preco_venda')
                        <div class="text-danger">{{ $message }}</div>              
                    @enderror --}}
                </div>

                <div class="form-group">
                    <label for="tipo_cadastro">Tipo de cadastro*</label>
                    <input type="text" name="tipo_cadastro" value=" {{ $cliente->tipo_cadastro }}">
                    {{-- @error('cfop')
                        <div class="text-danger">{{ $message }}</div>              
                    @enderror --}}
                </div>
                <button type="submit">Update Product</button>
            </form>
        </div>  
    </div>
