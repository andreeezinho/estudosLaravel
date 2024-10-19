@extends('layout.main')

{{-- pegando titulo da banco de dados atraves da variavel passada no Eventocontrol --}}
@section('title', $eventos->titulo)

@section('content')
    <div class="col-md-10 offset-md-1 mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="/img/eventos/{{$eventos->imagem}}" alt="Imagem teste" class="col-12">
            </div>
    
            <div class="col-md-6">
                <h1>{{$eventos->titulo}}</h1>
                <p class="p-2">Cidade: {{$eventos->cidade}}</p>
                                    
                                    {{-- pegando nome do usuario atraves do id_user (user) e puxa a coluna nome (name)  --}}
                <p class="p-2">Nome criador: {{$eventos->user->name}}</p>
                <p class="p-2">Data: {{date('d/m/y H:i', strtotime($eventos->datahora))}}</p>
                <p class="p-2">Evento privado: {{$eventos->privado}}</p>

                                            {{-- pegando o COUNT atraves da relação many to many deles (POR ISSO QUE USERS ESTÁ NO PLURAL) --}}
                <p class="p-2">Participantes: {{count($eventos->users)}}</p>
                <p class="p-2">{{$eventos->descricao}}</p>

                {{-- PEGA A VARIAVEL QUE VERIFICA SE USUARIO JA PARTICIPA --}}
                @if($participa == true)
                    <div class="btn btn-success">Já participa</div>
                @else
                    <form action="/eventos/participar/{{$eventos->id}}" method="POST">
                        @csrf
                        <a href="/eventos/participar/{{$eventos->id}}" class="btn btn-danger" id="submit" onclick="event.preventDefault(); this.closest('form').submit();">Confirmar presença</a>
                    </form>
                @endif

                {{-- imprimindo array json do banco de dados --}}
                @if(isset($eventos->itens))
                    <h3>O evento conta com:</h3>

                    <ul class="items-list">
                        @foreach ($eventos->itens as $item)
                            <li>{{$item}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection