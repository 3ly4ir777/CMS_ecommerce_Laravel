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
        Schema::create('orders', function (Blueprint $table) {
            // $table->ulid('id')->primary();
            // $table->string('customer_name');
            // $table->decimal('total', 10, 2)->default(0);
            // $table->enum('status', ['pendiente', 'pagada', 'enviada', 'entregada', 'cancelada'])->default('pendiente');
            // $table->timestamps();
            $table->id()->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // producto
            $table->decimal('total', 10, 2)->default(0); // total
            $table->string('status')->default('pendiente'); // estado
            $table->string('shipping_adress'); // direccion de envio
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
