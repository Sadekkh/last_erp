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
            'stock_transactions',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('workshop_id');
                $table->unsignedBigInteger('garage_id');
                $table->unsignedBigInteger('truck_id');
                $table->unsignedBigInteger('stocked_item_id');
                $table->unsignedBigInteger('stock_employee_id');
                $table->unsignedBigInteger('worker_id');
                $table->integer('quantity_taken');
                $table->timestamps();

                $table->foreign('workshop_id')->references('id')->on('workshops');
                $table->foreign('garage_id')->references('id')->on('garages');
                $table->foreign('maintenance_orders_id')->references('id')->on('maintenance_orders');
                $table->foreign('truck_id')->references('id')->on('trucks');
                $table->foreign('stocked_item_id')->references('id')->on('stocked_items');
                $table->foreign('stock_employee_id')->references('id')->on('users');
                $table->foreign('worker_id')->references('id')->on('workers');
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
