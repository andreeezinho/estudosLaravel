<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            //inserindo uma chave estrangeira na tabela EVENTOS
            $table->foreignId('user_id')->constrained(); //atrelar a um ususario de outra tabela
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            //remover os registros que estão atrelados ao usuario
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};
