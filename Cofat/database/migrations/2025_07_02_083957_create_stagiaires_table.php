<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->string('cin')->unique();
            $table->string('full_name');
            $table->date('birth_date');
            $table->enum('genre', ['male', 'female']);
            $table->string('phone_number');
            $table->string('education_level');
            $table->text('address');
            $table->string('school');
            $table->string('field_of_study');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stagiaires');
    }
};