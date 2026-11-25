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
        Schema::create('products', function (Blueprint $table) {
            // $table->ulid('id')->primary();
            $table->id()->primary();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade'); // categoria, reinterpretacion en clase
            $table->string('name'); // nombre
            $table->text('description')->nullable(); // descripcion
            $table->decimal('price', 10, 2); // precio
            $table->integer('stock')->default(0); // stock
            $table->string('image')->nullable(); // imagen (creado nuevo en clase)
            $table->boolean('is_active')->default(true); // activo (creado nuevo en clase)
            // $table->string('category')->nullable(); // categoria
            // $table->json('attributes')->nullable(); // Extra para hacer el CMS adaptable
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
