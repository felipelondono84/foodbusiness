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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('employee');
            $table->date('payroll_date');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('overtime', 10, 2);
            $table->decimal('allowance', 10, 2);
            $table->decimal('deduction', 10, 2);
            $table->decimal('net_salary', 10, 2);
            
            // $table->foreignId('payroll_status_id')->constrained()->onDelete('cascade');
            // $table->foreignId('payroll_period_id')->constrained()->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
