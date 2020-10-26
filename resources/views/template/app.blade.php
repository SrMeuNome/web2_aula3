<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <title>@yield('nome_tela')</title>
</head>

<body>
    <nav class="nav nav-pills nav-fill bg-success ">
        <div class="nav-item"><a id="home-link" class="nav-link text-light" href="/">Home</a></div>
        <div class="nav-item"><a id="clubes-link" class="nav-link text-light" href="/clube">Clubes</a></div>
        <div class="nav-item"><a id="jogadores-link" class="nav-link text-light" href="/jogador">Jogadores</a></div>
        <div class="nav-item"><a id="posicoes-link" class="nav-link text-light" href="/posicao">Posições</a></div>
    </nav>

    @if (Session::has('salvar'))
        <div class="alert alert-success">
            {{Session::get('salvar')}}
        </div>
    @endif
    
    @if (Session::has('excluir'))
        <div class="alert alert-danger">
            {{Session::get('excluir')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{$e}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <fieldset>
            <legend class="title">Cadastro - @yield('nome_tela')</legend>
            <div class="cadastro">
                @yield('cadastro')
            </div>
        </fieldset>

        <fieldset>
            <legend class="title">Listagem - @yield('nome_tela')</legend>
            <div>
                @yield('listagem')
            </div>
        </fieldset>
    </div>
    
    @yield('tab-active')
</body>

</html>