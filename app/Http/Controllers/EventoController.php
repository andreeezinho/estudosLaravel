<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//importar model Evento
use App\Models\Evento;
use App\Models\User;

class EventoController extends Controller
{
    //chamada de index action
    public function index(){
        //request do input de procurar eventos
        $procurar = request('procurar');

        if($procurar){  
            //em vez de buscar todos os dados (ALL) busca o da pesquisa (WHERE)
            $eventos = Evento::where([
                ['titulo', 'like', '%'. $procurar .'%']
            ])->get(); //dizer que quer pegar os projetos do banco de dados para enviar os registos
        }else{
            //chamar todos os eventos do banco de dados EVENTOS
            $eventos = Evento::all();
        }

        return view('welcome', ['eventos' => $eventos, 'procurar' => $procurar]);
    }

    //retornar view eventos/criar
    public function criar(){
        return view('eventos.criar', []);
    }

    //funcao para colocar no banco de dados
    public function store(Request $request){
        //instanciar classe do model EVENTO
        $evento = new Evento;

        //instanciando dados do form para o objeto $request
        $evento->titulo = $request->titulo;
        $evento->cidade = $request->cidade;
        $evento->privado = $request->privado;
        $evento->descricao = $request->descricao;
        $evento->itens = $request->itens;
        $evento->datahora = $request->datahora;

        //upload de imagem no bando de dados
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requestImage = $request->imagem;

            //pegar nome do arquivo e transformar em md5
            $imageName = md5($requestImage->getclientOriginalName().strtotime("now")).".".$requestImage->getClientOriginalExtension();

            //veriavel para dizer qual sera o destino da imagem
            $destination = public_path('img/eventos');

            //adicionar a imagem na pasta no projeto
            $requestImage->move($destination, $imageName);

            //instanciar objeto evento para request para enviar para o banco usando o $imageName
            $evento->imagem = $imageName;
        }

        //verificar se usuario está autenticado
        $user = auth()->user();

        //acessando a coluna id do usuario logado
        $evento->user_id = $user->id;


        //salvar(enviar) para o banco de dados
        $evento->save();

        //redirecionar usuario para uma pagina
                             //metodo para flash mensagge para mostrar menasgem ao usuario
        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }


    //retornar view para eventos/idDoEvento
    public function detalhes($id){
        //resgatar id da view que o cliente solicitar
        $eventos = Evento::findOrFail($id);

        //pegar usuario logado
        $user = auth()->user();

        //verifica se usuario está logado
        $participa = false;

        //se user estiver logado...
        if($user){
            //transformando os dados em array
            $verificaEvento = $user->userEvento->toArray();

            //percorrer o array
            foreach($verificaEvento as $usuarioEvento){
                //se o id na tabela EVENTO_USER no evento for igual a esse evento
                if($usuarioEvento['id'] == $id){
                    //
                    $participa = true;
                }
            }
        }

        //se o usuario for dono do evento, tambem configura como participando
        if($user->id == $eventos->user_id){
            $participa = true;
        }
                                                            //manda a var para verificar se já participa ou nao
        return view('eventos.detalhes', ['eventos' => $eventos, 'participa' => $participa]);
    }

    //pegar usuario autenticado e retornar a view de dashboard
    public function dashboard(){
        //verifica se usuario está autenticado
        $user = auth()->user();

        $eventosUsuario = $user->eventos;

        //pegar os eventos do USER
        $userEventos = $user->userEvento;

        return view('eventos.dashboard', ['eventosUsuario' => $eventosUsuario, 'userEventos' => $userEventos]);
    }

    //deletar evento do usuario e retornar view
    public function deletar($id){
        //chamar model para encontrar a imagem atraves do id
        $imagemAntiga = Evento::findOrFail($id)->imagem;

        //verificar se existe uma imagem setada
        if($imagemAntiga){
            //excluir arquivo do diretorio do projeto
            unlink(public_path('/img/eventos/' . $imagemAntiga));
        }

        //resgatar id passado pelo parametros, procurar e deletar
        Evento::findOrFail($id)->delete();

                                    //redirecionar com uma mensagem que vai para a view
        return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso!');
    }


    //funcao para editar evento
    public function editar($id){
        //pegar usuario que está autenticado
        $user = auth()->user();

        //chamar Model EVENTO para encontrar a var ID
        $evento = Evento::findOrFail($id);

        //se usuario não for dono do evento, redirecionar para outro lugar
        if($user->id != $evento->user_id){
            return redirect('/dashboard');
        }

        //encaminhar para a view EDITAR
        return view('eventos.editar', ['evento' => $evento]);
    }

    //funcao para atualizar o evento
    public function atualizar(Request $id){
        //chamar model para encontrar o id
        $imagemAntiga = Evento::findOrFail($id->id);

        $dados = $id->all();

        //upload de imagem no bando de dados
        if($id->hasFile('imagem') && $id->file('imagem')->isValid()){
            //verificar se realmente existe uma imagem setada
            if($imagemAntiga->imagem){
                unlink(public_path('/img/eventos/' . $imagemAntiga->imagem));
            }

            $requestImage = $id->imagem;

            //pegar nome do arquivo e transformar em md5
            $imageName = md5($requestImage->getclientOriginalName().strtotime("now")).".".$requestImage->getClientOriginalExtension();

            //veriavel para dizer qual sera o destino da imagem
            $destination = public_path('img/eventos');

            //adicionar a imagem na pasta no projeto
            $requestImage->move($destination, $imageName);

            //define que o nome da imagem é a nova selecionada
            $dados['imagem'] = $imageName;
        }


        //encontrar ID que veio do parametro    update baseado em todos os dados da requisição
        Evento::findOrFail($id->id)->update($dados);

        return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso');
    }

    //funcao para fazer o usuario participar de um evento
    public function participar($id){
        //pegar um usuario que esteja autenticado
        $user = auth()->user();

        //registrar usuario no evento
            //pegando a função do MODEL/User
                        //inserir id do user e id do evento
        $user->userEvento()->attach($id);

        $nomeEvento = Evento::findOrFail($id);

        //retornar a tela anterior que o usuario estava
        return back()->with('msg', 'Voce está participando do evento: ' . $nomeEvento->titulo);
    }

    //funcao para usuario sair do evento
    public function sair($id){
        //pegar um usuario autenticado
        $user = auth()->user();

        //remover a ligação que tem no banco de dados (many to many)
                        //remover o id do user e do evento
        $user->userEvento()->detach($id);

        //encontrar o ID do evento
        $evento = Evento::findOrFail($id);

        //retornar a tela de dashboard
        return redirect('/dashboard')->with('msg', 'Voce saiu do evento: ' . $evento->titulo);
    }
}
