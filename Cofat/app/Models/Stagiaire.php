<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'cin',
        'full_name',
        'birth_date',
        'genre',
        'phone_number',
        'education_level',
        'address',
        'school',
        'field_of_study',
        'start_date',
        'end_date',
        'avatar'
    ];


    protected $casts = [
    'birth_date' => 'date',
    'start_date' => 'date',
    'end_date' => 'date',
];
    public function getAgeAttribute()
    {
        if (!$this->birth_date) {
            return null;
        }
        
        // Ensure birth_date is a Carbon instance
        $birthDate = $this->birth_date instanceof \Carbon\Carbon 
            ? $this->birth_date 
            : \Carbon\Carbon::parse($this->birth_date);
        
        return $birthDate->age;
    }

    public function getDurationAttribute()
    {
        return $this->start_date->diffInMonths($this->end_date);
    }
}