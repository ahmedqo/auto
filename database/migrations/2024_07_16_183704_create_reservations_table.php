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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company')->nullable();
            $table->unsignedBigInteger('client')->nullable();
            $table->unsignedBigInteger('vehicle')->nullable();
            $table->unsignedBigInteger('secondary_client')->nullable();
            $table->string('ref');
            $table->dateTime('from');
            $table->string('pick_up')->nullable();
            $table->dateTime('to');
            $table->string('drop_off')->nullable();
            $table->integer('period');
            $table->float('price', 15, 5);
            $table->float('total', 15, 5);
            $table->json('payment');
            $table->json('state');
            $table->string('status');
            $table->timestamps();

            $table->foreign('company')->references('id')->on('companies')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('client')->references('id')->on('clients')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('vehicle')->references('id')->on('vehicles')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('secondary_client')->references('id')->on('clients')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
