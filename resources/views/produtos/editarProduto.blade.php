<head>
    <title>Editar Produto {{ $produto->id}} </title>
    <link rel="stylesheet" href="/css/editarProduto.css">

</head>

<div class="scope">
    @include('main.sidebar')
    <div class="forms_show_de_bola">
        <form action="{{ url('/produto/' . $produto->id  ) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome*</label>
                <input type="text" name="nome" id="nome" value="{{ $produto->nome }}">
                @error('nome')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="qte">Quantia*</label>
                <input type="text" name="qte" id="qte" value="{{ $produto->qte }}">
                @error('qte')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="cod_gtin">Código de Barras GTIN</label>
                <input type="text" name="cod_gtin" id="cod_gtin" value="{{ $produto->cod_gtin }}">
                @error('cod_gtin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="preco_venda">Preço venda*</label>
                <input type="text" name="preco_venda" id="preco_venda" value="{{ $produto->preco_venda }}">
                @error('preco_venda')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="cfop">CFOP*</label>
                <input type="text" name="cfop" id="cfop" value="{{ $produto->cfop }}">
                @error('cfop')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            
            <div class="form-group">
                <label for="csosn">CSOSN*</label>
                <input type="text" name="csosn" id="csosn" value="{{ $produto->csosn }}">
                @error('csosn')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            
            <div class="form-group">
                <label for="ncm">NCM*</label>
                <input type="text" name="ncm" id="ncm" value="{{ $produto->ncm }}">
                @error('ncm')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
            </div>
            <button type="submit">Update Product</button>
        </form>
 
    </div>
</div>