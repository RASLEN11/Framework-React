<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'type',
        'date',
        'trainer',
        'note',
        'next_qualification_date'
    ];

    protected $casts = [
        'date' => 'date',
        'next_qualification_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}