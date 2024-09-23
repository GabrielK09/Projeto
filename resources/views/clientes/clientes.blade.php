<head>
    <link rel="stylesheet" href="/css/clientes.css">
</head>

<div class="scope">
    @include('main.sidebar')
    
    <h1>Todas os cliente</h1>

    <a href="/clientes/cadastro"><button class="btn cadastrarCliente">Cadastrar Clientes</button></a>

    <div class="grid">
        @foreach ($clientes as $cliente)   
            <p> Nome: {{$cliente->nome_completo }} </p>
            <p> CPF: {{$cliente->cpf }} </p>
            <p> Data de Nascimento: {{$cliente->data_nascimento }} </p>

            <a href="/cliente/editar/{{ $cliente->id }}"><button>Editar cliente</button></a>
        @endforeach

    </div>
</div>

