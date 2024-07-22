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
            $table->string('slug');
            $table->string('name');
            $table->float('price', 15, 5);
            $table->integer('passengers');
            $table->float('milage', 15, 5);
            $table->integer('doors');
            $table->integer('cargo');
            $table->string('transmission');
            $table->string('fuel');
            $table->text('details')->nullable();
            $table->timestamps();

            $table->unique(['company', 'slug']);
            $table->unique(['company', 'name']);
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
