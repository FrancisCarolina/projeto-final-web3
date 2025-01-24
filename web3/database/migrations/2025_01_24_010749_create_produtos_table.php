<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('caminho_imagem')->nullable(); // Para armazenar o caminho da imagem
            $table->foreignId('categoria_id')->constrained('categories'); // Chave estrangeira para categorias
            $table->foreignId('unidade_medida_id')->constrained('unidades'); // Chave estrangeira para unidade de medida
            $table->integer('estoque');
            $table->text('descricao');
            $table->decimal('valor_unitario', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
