<?php

use Illuminate\Support\Facades\Route;

//importar controllers
use App\Http\Controllers\EventoController;

//passar rota atraves do controller
Route::get('/', [EventoController::class, 'index']);

//rota para ver a tela de criar evento                           //rota só é acessado por meio de usuario logado
Route::get('/eventos/criar', [EventoController::class, 'criar'])->middleware('auth');

//rota para ver o detalhe do evento
Route::get('/eventos/{id}', [EventoController::class, 'detalhes']);

//rota para EVENTOCONTROLLER COM O METODo POST no banco de dados
Route::post('/eventos', [EventoController::class, 'store']);

//rota para dashboard do usuario
Route::get('/dashboard', [EventoController::class, 'dashboard'])->middleware('auth');

//rota para deletar evento
Route::delete('/eventos/{id}', [EventoController::class, 'deletar'])->middleware('auth');

//rota para view de editar usuario
Route::get('/eventos/editar/{id}', [EventoController::class, 'editar'])->middleware('auth');

//rota para atualizar o usuario
Route::put('/eventos/atualizar/{id}', [EventoController::class, 'atualizar'])->middleware('auth');

//rota para usuario participar de um evento
Route::post('/eventos/participar/{id}', [EventoController::class, 'participar'])->middleware('auth');

//rota para usuario sair do evento
Route::delete('/eventos/sair/{id}', [EventoController::class, 'sair'])->middleware('auth');