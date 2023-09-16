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
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 5, 2);
            $table->boolean('active')->default(true);
            $table->decimal('cost', 5, 2);
            $table->integer('stock')->nullable();
            $table->unique(['name', 'company_id']);
            $table->foreignUuid('company_id')->constrained('companies');
            $table->foreignUuid('category_id')->constrained('categories');

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
