<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocked_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('stock_id');
            $table->string('serial_num')->nullable();
            $table->integer('unit_storage')->default(1);
            $table->integer('unit_left')->default(DB::raw('`unit_storage`'));
            $table->enum('state', ['available', 'unavailable', 'damaged'])->default('available');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('stock_id')->references('id')->on('stocks');
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
