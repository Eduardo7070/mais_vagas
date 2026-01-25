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
        Schema::create('vagas', function (Blueprint $table) {
            $table->id('vagas_id');
            $table->timestamps();
            $table->foreignId('companie_id')
                ->references('companie_id')
                ->on('companies')
                ->cascadeOnDelete();
            $table->string('nome_vaga');
            $table->string('desc_vaga');
            $table->string('salario_vaga');
            $table->enum(
                'area_vaga',
                [
                    'Tecnologia',
                    'Administrativo',
                    'Saúde',
                    'Educacional'
                ]
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
