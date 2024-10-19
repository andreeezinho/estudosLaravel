<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    //coluna ITENS do banco de dados como array (por que ele é em formato JSON) 
            //o nome da variavel é obrigatorio ser $casts
    protected $casts = [
        'itens' => 'array'
    ];

    //informar que o campo datahora é do tipo DATE
    protected $dates = ['datahora'];

    //informar que tudo que for enviado por POST pode ser atualizado (se tiver vazio pode atualizar tudo)
    protected $guarded = [];

    //informar que evento pertence a algum usuario do Model User
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //infomar que VARIOS eventos possuem VARIOS usuarios
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
