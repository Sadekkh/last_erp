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
        Schema::create('maintenance_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_order_id');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->dateTime('entry_time')->nullable();
            $table->dateTime('leaving_time')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->text('description');
            $table->timestamps();

            $table->foreign('maintenance_order_id')->references('id')->on('maintenance_orders')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->foreign('product_id')->references('id')->on('products');
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
