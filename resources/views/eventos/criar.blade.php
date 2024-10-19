@extends('layout.main')

@section('title', 'Criar Evento')

@section('content')
    <div class="col-md-6 offset-md-3 mt-5">
        <h1>Crie seu evento</h1>

        <form action="/eventos" method="POST" enctype="multipart/form-data">
            {{-- diretiva para o laravel liberar o POST --}}
            @csrf
            <div class="form-group">
                <label for="imagem">Imagem do evento</label>
                <input type="file" name="imagem" id="imagem" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="titulo">Evento</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Insirta Titulo">
            </div>

            <div class="form-group">
                <label for="cidade">cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Insirta cidade">
            </div>

            <div class="form-group">
                <label for="privado">privado</label>
                <select name="privado" id="privado" class="form-control">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="datahora">Data e hora</label>
                <input type="datetime-local" name="datahora" id="datahora" class="form-control">
            </div>

            <div class="form-group">
                <label for="descricao">descricao</label>
                <textarea name="descricao" id="descricao"class="form-control"></textarea>
            </div>

            {{-- itens que vao ser passado atraves de JSON --}}
            <div class="form-group">
                <label for="itens">Itens</label>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value="Cadeiras"> Cadeiras
                    <input type="checkbox" name="itens[]" value="Palco"> Palco
                    <input type="checkbox" name="itens[]" value="Ceiirrveja"> Ceiirrveja
                    <input type="checkbox" name="itens[]" value="Openfood"> Openfood
                    <input type="checkbox" name="itens[]" value="Openfood"> Openfood
                    <input type="checkbox" name="itens[]" value="Brindes"> Brindes
                </div>
            </div>

            <input type="submit" value="Criar Evento" class="btn btn-danger">
        </form>
    </div>
@endsection
