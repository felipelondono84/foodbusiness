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
        Schema::table('amounts', function (Blueprint $table) {
            $table->foreignId('responsible_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('deposito');
            $table->date('date_entrega')->nullable();
            $table->date('date_recibido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('amounts', function (Blueprint $table) {
            //
        });
    }
};