<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    protected $fillable = [
        'job_applications_enabled',
        'internship_applications_enabled'
    ];
}