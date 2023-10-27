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
        Schema::create(
            'requests',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('garage_id');
                $table->unsignedBigInteger('deal_id')->nullable();

                $table->date('date')->nullable();
                $table->enum('payment', ['cash', 'transaction'])->nullable();
                $table->date('delay_to')->nullable();
                $table->text('currency')->nullable();
                $table->text('announcement')->nullable();
                $table->text('cash_account')->nullable();
                $table->text('refrence')->nullable();
                $table->text('refrence_number')->nullable();
                $table->date('refrence_date')->nullable();
                $table->date('supply')->nullable();
                $table->text('sales_emp')->nullable();
                $table->date('side_project')->nullable();
                $table->enum('delay', ['cash', 'transaction'])->nullable();
                $table->enum('state', ['in_build', 'p_section_manager', 'p_managing_director', 'p_director', 'confirmed', 'cancelled', 'closed'])->default('in_build');
                $table->text('code')->unique()->nullable();

                $table->timestamps();
                $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
                $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
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
