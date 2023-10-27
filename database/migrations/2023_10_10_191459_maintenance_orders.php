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
        Schema::create('maintenance_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('truck_id');
            $table->unsignedBigInteger('truck_trailer_id')->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('workshop_id');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedBigInteger('diag_emp')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->enum('source', ['insider', 'outsider'])->default('insider');
            $table->enum('entry_state', ['normal', 'picked_up'])->default('normal');
            $table->dateTime('entry_time')->nullable();
            $table->dateTime('approximate_leaving_time')->nullable();
            $table->dateTime('leaving_time')->nullable();
            $table->text('complain')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->text('code')->unique()->nullable();

            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->foreign('truck_trailer_id')->references('id')->on('trucks');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->foreign('deal_id')->references('id')->on('deals');
            $table->foreign('diag_emp')->references('id')->on('workers');
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
