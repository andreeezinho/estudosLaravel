@extends('layout.main')

@section('title', 'Editar Evento')

@section('content')
    <div class="col-md-6 offset-md-3 mt-5">
        <h1>Editar Evento porra</h1>

        <form action="/eventos/atualizar/{{$evento->id}}" method="POST" enctype="multipart/form-data">
            {{-- diretiva para o laravel liberar o PUT --}}
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="imagem">Imagem do evento</label>
                <input type="file" name="imagem" id="imagem" class="form-control-file">
                <img src="/img/eventos/{{$evento->imagem}}" alt="nada" width="300px">
            </div>

            <div class="form-group">
                <label for="titulo">Evento</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Insirta Titulo" value="{{$evento->titulo}}">
            </div>

            <div class="form-group">
                <label for="cidade">cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Insirta cidade" value="{{$evento->cidade}}">
            </div>

            <div class="form-group">
                <label for="privado">privado</label>
                <select name="privado" id="privado" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{$evento->privado == 1 ? "selected = 'selected'" : ""}}>Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="datahora">Data e hora</label>
                <input type="datetime-local" name="datahora" id="datahora" class="form-control" value="{{date('Y-m-d h:m', strtotime($evento->datahora))}}">
            </div>

            <div class="form-group">
                <label for="descricao">descricao</label>
                <textarea name="descricao" id="descricao"class="form-control">{{$evento->descricao}}</textarea>
            </div>

            {{-- itens que vao ser passado atraves de JSON --}}
            <div class="form-group">
                <label for="itens">Itens</label>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value="Cadeiras" {{in_array("Cadeiras", $evento->itens) ? "checked = 'checked'" : ""}}> Cadeiras
                    <input type="checkbox" name="itens[]" value="Palco" {{in_array("Palco", $evento->itens) ? "checked = 'checked'" : ""}}> Palco
                    <input type="checkbox" name="itens[]" value="Ceiirrveja" {{in_array("Ceiirrveja", $evento->itens) ? "checked = 'checked'" : ""}}> Ceiirrveja
                    <input type="checkbox" name="itens[]" value="Openfood" {{in_array("Openfood", $evento->itens) ? "checked = 'checked'" : ""}}> Openfood
                    <input type="checkbox" name="itens[]" value="Openfood" {{in_array("Openfood", $evento->itens) ? "checked = 'checked'" : ""}}> Openfood
                    <input type="checkbox" name="itens[]" value="Brindes" {{in_array("Brindes", $evento->itens) ? "checked = 'checked'" : ""}}> Brindes
                </div>
            </div>

            <input type="submit" value="criarEvento" class="btn btn-danger">
        </form>
    </div>
@endsection