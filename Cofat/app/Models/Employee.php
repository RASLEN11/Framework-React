<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'cin',
        'full_name',
        'birth_date',
        'genre',
        'phone_number',
        'address',
        'education_level',
        'hire_date',
        'category',
        'avatar'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'hire_date' => 'date',
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }
}