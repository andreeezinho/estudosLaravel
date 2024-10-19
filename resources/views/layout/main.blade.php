<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-danger">
            <a href="/" class="navbar-brand">LOGO PROJETO</a>
    
            <div class="collapse navbar-collapse" id="menu">
                <div class="navbar-nav">
                    <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="/eventos/criar" class="nav-link">Criar Evento</a></li>
                    @auth
                        <li class="nav-item"><a href="/dashboard" class="nav-link">Meu perfil</a></li>

                        {{-- link para logout --}}
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="/register" class="nav-link">Registrar</a></li>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <section class="content-section pb-5">
        {{-- passando session para mostrar mensagem --}}
        @if(session('msg'))
            <div class="alert alert-success">
                <p class="p-0 m-0">{{session('msg')}}</p>
            </div>
        @endif

        @yield('content')
    </section>

    <footer class="bg-dark">
        <h1 class="text-light">OLAAAAAAAAAAAAA</h1>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>