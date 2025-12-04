<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_type',
        'cin',
        'first_name',
        'last_name',
        'age',
        'phone',
        'email',
        'education_level',
        'school',
        'field_of_study',
        'duration',
        'cv_path',
        'cover_letter',
        'terms_accepted',
        'status'
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'status' => 'string',
    ];

    // Optionally, you can define constants for status values
    public const STATUS_PENDING = 'pending';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    // Optionally, you can add a method to get all possible statuses
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_UNDER_REVIEW,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
        ];
    }
}