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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');

            $table->unsignedBigInteger('entity_id');
            $table->string('entity_type');
            $table->unsignedBigInteger('maintenance_orders_id')->nullable();

            $table->timestamps();
            $table->foreign('maintenance_orders_id')->references('id')->on('maintenance_orders');
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
