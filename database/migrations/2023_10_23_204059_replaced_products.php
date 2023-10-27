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
        Schema::create('replaced_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_task_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('old_item_id');
            $table->unsignedBigInteger('new_item_id');
            $table->unsignedBigInteger('truck_id');
            $table->string('old_serial_num');
            $table->string('oil_amount');
            $table->string('wheel_position');
            $table->enum('old_prod_desc', ['on_guarantee', 'back_to_stock', 'backed_to_stock', 'damaged']);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('maintenance_task_id')->references('id')->on('maintenance_tasks');
            $table->foreign('old_item_id')->references('id')->on('stocked_items');
            $table->foreign('new_item_id')->references('id')->on('stocked_items');
            $table->foreign('truck_id')->references('id')->on('trucks');
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
