<?php

use App\Functions\Core;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('identity')->unique();
            $table->string('identity_type')->nullable();
            $table->string('nationality')->nullable();
            $table->string('license_number')->unique();
            $table->enum('gender', Core::genderList())->nullable();
            $table->date('birth_date')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
