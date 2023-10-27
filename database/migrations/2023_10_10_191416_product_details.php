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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->text('model')->nullable();
            $table->decimal('min_quantity_stored', 10, 2)->nullable();
            $table->decimal('max_quantity_stored', 10, 2)->nullable();
            $table->decimal('min_purchase_price', 10, 2)->nullable();
            $table->decimal('max_purchase_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('transport_price', 10, 2)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('virtual_quantity', 10, 2)->nullable();
            $table->enum('request_type', ['by_agent', 'by_factory'])->nullable();
            $table->enum('unit', ['litre', 'kilo', 'piece'])->default('piece');
            $table->enum('state', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
