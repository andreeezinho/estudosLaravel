@extends('layout.main')

@section('title', 'Painel ADM')

@section('content')

    <div class="col-md10 offset-md-1">
        <h1>DashBoard ADM</h1>
    </div>

    <div class="col-md10 offset-md-1">
        @if(count($eventosUsuario) > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Participantes</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($eventosUsuario as $evento)
                        <tr>
                                    {{-- pega o numero do item e aumenta em um --}}
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$evento->titulo}}</td>
                            <td>{{count($evento->users)}} participantes</td>
                            <td class="d-flex">
                                <a href="/eventos/editar/{{$evento->id}}" class="btn btn-primary">Editar</a>

                                {{-- botao para deletar o evento --}}
                                <form action="/eventos/{{$evento->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h2>Voce ainda nao tem eventos... <a href="/eventos/criar">Crie aqui porra</a></h2>
        @endif
    </div>

    <div class="col-md-10 offset-md-1 mt-5">
        <h1>Eventos participando</h1>

        @if(count($userEventos) > 0)
            @foreach($userEventos as $evento)
            <div class="card col-md-3">
                <img src="/img/eventos/{{$evento->imagem}}" alt="{{$evento->titulo}}">
                <div class="card-body">
                    <p class="card-date">{{date('d/m/y', strtotime($evento->datahora))}}</p>
                    <h5 class="card-title">{{$evento->titulo}}</h5>

                    {{-- botao para deletar o evento --}}
                    <form action="/eventos/sair/{{$evento->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
            @endforeach
        @else
            <h1>Não está participando de nada ainda... <a href="/">Participe aqui</a></h1>
        @endif
    </div>

@endsection