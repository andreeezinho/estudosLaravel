@extends('layout.main')

@section('title', 'Home')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1 class="mt-5">Busque um evento</h1>

        <form action="/" method="GET">
            <input type="text" name="procurar" id="procurar" class="form-control" placeholder="Procurar evento">
        </form>
    </div>

    <div id="events-container" class="col-md-12 mt-3">
        @if($procurar)
            <h2>Buscando por: {{$procurar}}</h2>
            <p class="text-muted small">Resultado da pesquisa</p>
        @else
            <h2>Próximos eventos</h2>
            <p class="text-muted small">Veja os eventos dos próximos dias</p>
        @endif

        <div id="cards-container" class="row">
            @if(count($eventos) > 0)
                {{-- consultar dados do banco de dados --}}
                @foreach ($eventos as $evento)
                    <div class="card col-md-3">
                        <img src="/img/eventos/{{$evento->imagem}}" alt="{{$evento->titulo}}">
                        <div class="card-body">
                            <p class="card-date">{{date('d/m/y', strtotime($evento->datahora))}}</p>
                            <h5 class="card-title">{{$evento->titulo}}</h5>
                            <p class="card-participants">{{count($evento->users)}} participantes</p>
                            <a href="/eventos/{{$evento->id}}" class="btn btn-danger">Saber mais</a>
                        </div>
                    </div>
                @endforeach
            @elseif(count($eventos) == 0 && $procurar)
                <h2 class="text-danger">Não foi possível encontrar eventos com {{$procurar}} <a href="/">Ver todos os eventos aqui</a></h2>
            @else
                <h2 class="text-danger">Não há eventos disponíveis ainda :/</h2>
            @endif
        </div>
    </div>

@endsection
