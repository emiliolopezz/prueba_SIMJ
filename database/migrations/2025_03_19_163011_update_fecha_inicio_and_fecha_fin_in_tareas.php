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

        Schema::table('tareas', function (Blueprint $table) {
            // Cambiar el tipo de la columna a DATETIME
            $table->dateTime('fecha_inicio')->change();
            $table->dateTime('fecha_fin')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('tareas', function (Blueprint $table) {
            // Revertir el cambio si es necesario
            $table->date('fecha_inicio')->change();
            $table->date('fecha_fin')->change();
        });
    }
};
