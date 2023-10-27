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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('garage_id');
            $table->unsignedBigInteger('brands_id')->nullable();



            $table->decimal('tax', 10, 2);
            $table->decimal('price', 10, 2);
         
            $table->string('rows')->nullable();
            $table->string('columns')->nullable();
            $table->string('reference')->nullable();
            $table->date('purchase_date');
            $table->date('expiry_date')->nullable();
            $table->date('guarantee_expiry_date')->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('request_id')->references('id')->on('requests');
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->foreign('brands_id')->references('id')->on('brands')->onDelete('cascade');
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
