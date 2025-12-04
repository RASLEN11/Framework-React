<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->enum('position_type', ['office', 'factory']);
            $table->string('cin', 20);
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('phone');
            $table->string('email');
            $table->enum('education_level', [
                'high_school', 'vocational', 'bachelor', 'master'
            ]);
            $table->string('school');
            $table->string('field_of_study');
            $table->integer('duration');
            $table->string('cv_path');
            $table->text('cover_letter')->nullable();
            $table->boolean('terms_accepted');
            $table->enum('status', [
                'pending', 'under_review', 'approved', 'rejected'
            ])->default('pending');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('internship_applications');
    }
};