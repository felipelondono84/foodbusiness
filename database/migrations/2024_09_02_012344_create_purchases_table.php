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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('unit_of_measurement');
            $table->string('quantity');
            $table->string('cash');
            $table->string('payment_method');
            // $table->foreignId('payment_status_id')->constrained()->onDelete('cascade');
            // $table->foreignId('order_status_id')->constrained()->onDelete('cascade');
            // $table->foreignId('shipping_status_id')->constrained()->onDelete('cascade');
            // $table->foreignId('shipping_method_id')->constrained()->onDelete('cascade');
            // $table->foreignId('shipping_address_id')->constrained()->onDelete('cascade');
            // $table->foreignId('billing_address_id')->constrained()->onDelete('cascade');
            // $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
         
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
