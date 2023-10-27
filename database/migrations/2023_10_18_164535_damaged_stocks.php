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
        Schema::create('damaged_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('stock_item_id');
            $table->unsignedBigInteger('maintenance_order_id');
            $table->unsignedBigInteger('driver_id');

            $table->enum('reason', ['normal', 'driver_mistake', 'technical_error']);
            $table->enum('state', ['pending', 'done'])->default('pending');
            $table->string('description');
            $table->string('taken_actions')->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('stock_item_id')->references('id')->on('stocked_items');
            $table->foreign('maintenance_order_id')->references('id')->on('maintenance_orders');
            $table->foreign('driver_id')->references('id')->on('drivers');
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
