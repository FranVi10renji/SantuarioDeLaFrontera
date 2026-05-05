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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre, 100');
            $table->string('especie, 100');
            $table->json('rasgos');
            $table->integer('anno_nacimiento')->unsigned();
            $table->string('sexo, 1');
            $table->float('peso')->unsigned();
            $table->float('tamaño')->unsigned();
            $table->string('dieta');
            $table->string('grupo');
            $table->boolean('castrado')->default(false);
            $table->string('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
