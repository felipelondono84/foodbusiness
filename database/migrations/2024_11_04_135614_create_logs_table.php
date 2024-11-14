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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Relación con usuarios
            $table->string('action'); // Acción realizada, por ejemplo: 'created', 'updated', 'deleted'
            $table->string('model'); // Nombre del modelo afectado
            $table->string('record_id')->nullable(); // ID del registro afectado
            $table->text('changes')->nullable(); // Detalles de los cambios realizados
            $table->timestamps(); // Campos de fe
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
