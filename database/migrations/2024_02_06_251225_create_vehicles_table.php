<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model')->nullable();
            $table->unsignedBigInteger('brand')->nullable();
            $table->string('slug')->unique();
            $table->string('name_en')->unique();
            $table->float('price', 15, 5);
            $table->integer('passengers');
            $table->integer('doors');
            $table->integer('cargo');
            $table->string('transmission');
            $table->string('fuel');
            $table->string('status');
            $table->text('details_en')->nullable();
            $table->longText('description_en')->nullable();
            $table->timestamps();

            $table->foreign('brand')->references('id')->on('brands')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('model')->references('id')->on('models')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
