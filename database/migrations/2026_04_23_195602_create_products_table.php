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
        $table->id();

        $table->string('name');

        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('company_id')->constrained()->onDelete('cascade');

        $table->string('location')->nullable();

        $table->decimal('purchase_rate', 10, 2);
        $table->decimal('sale_rate', 10, 2);
        $table->decimal('whole_sale_rate', 10, 2)->nullable();

        $table->decimal('roi', 10, 2)->nullable();

        $table->string('asin')->unique();
        $table->string('barcode')->unique();

        $table->text('summary')->nullable();

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
