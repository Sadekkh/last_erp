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
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->integer('year');
            $table->string('number_wheels');
            $table->decimal('oil_change', 10, 2);
            $table->string('vin')->unique();
            $table->integer('mileage');
            $table->date('last_check')->nullable();
            $table->date('next_check')->nullable();
            $table->enum('type', ['truck', 'trailer']);
            $table->enum('source', ['insider', 'outsider'])->default('insider');
            $table->timestamps();
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
