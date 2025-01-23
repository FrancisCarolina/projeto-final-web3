<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->unsignedBigInteger('address_id')->nullable(); // Relacionamento com endereço
            $table->timestamps();

            // Chave estrangeira para a tabela de endereços
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
