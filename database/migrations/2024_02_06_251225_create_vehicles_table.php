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
            $table->unsignedBigInteger('company')->nullable();
            $table->date('circulation');
            $table->string('brand');
            $table->string('model');
            $table->string('horsepower');
            $table->float('horsepower_tax', 15, 5);
            $table->string('insurance');
            $table->float('insurance_cost', 15, 5);
            $table->string('registration');
            $table->integer('year');
            $table->float('price', 15, 5);
            $table->integer('passengers');
            $table->float('mileage', 15, 5);
            $table->integer('doors');
            $table->integer('cargo');
            $table->string('transmission');
            $table->string('fuel');
            // $table->text('details')->nullable();
            $table->timestamps();

            $table->foreign('company')->references('id')->on('companies')->onUpdate('cascade')->onDelete('set null');
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
