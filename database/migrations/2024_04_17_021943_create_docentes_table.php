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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id(); //integer, autoincrement, primary key
            $table->string('rfc',15)->unique(); 
            $table->string('nombre');;
            $table->string('ap_paterno');
            $table->string('ap_materno')->nullable(false);;
            $table->string('curp')->unique();;
            $table->string('email')->unique();;
            $table->unsignedInteger('user_ide');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
