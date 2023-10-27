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
        Schema::create(
            'requested_items',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('request_id');
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('supplier_id');
                $table->integer('quantity_requested');
                $table->integer('quantity_given')->nullable();
                $table->integer('approx_price');
                $table->enum('state', ['pending', 'done'])->default('pending');

                $table->timestamps();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
                $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
