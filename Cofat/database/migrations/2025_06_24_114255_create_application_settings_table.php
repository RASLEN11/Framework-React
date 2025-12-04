<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('job_applications_enabled')->default(false);
            $table->boolean('internship_applications_enabled')->default(false);
            $table->timestamps();
        });

        // Insert default settings
        DB::table('application_settings')->insert([
            'job_applications_enabled' => false,
            'internship_applications_enabled' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('application_settings');
    }
};