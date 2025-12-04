<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('cin')->unique();
            $table->string('full_name');
            $table->date('birth_date');
            $table->integer('age')->virtualAs('TIMESTAMPDIFF(YEAR, birth_date, CURDATE())');
            $table->enum('genre', ['male', 'female']);
            $table->string('phone_number');
            $table->text('address');
            $table->enum('education_level', [
                'primaire', 'college', 'lycee', 'bac', 
                'bac_1', 'bac_2', 'bac_3', 'bac_4', 
                'bac_5', 'bac_6'
            ]);
            $table->date('hire_date');
            $table->integer('seniority')->virtualAs('TIMESTAMPDIFF(YEAR, hire_date, CURDATE())');
            $table->enum('category', ['direct', 'indirect']);
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};