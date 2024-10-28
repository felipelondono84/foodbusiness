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
        Schema::create('management_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activities_id');
            $table->foreignId('users_id');
            $table->foreignId('comanpanies_id');
            $table->enum('type',['start', 'finished'])->default('start');
            $table->timestamp('day_in')->nullable();
            $table->timestamp('day_out')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management_activities');
    }
};
