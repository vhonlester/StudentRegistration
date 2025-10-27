<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'section_id'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the section that owns the student.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
