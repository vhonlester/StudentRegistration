<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'capacity'
    ];

    /**
     * Get the students for the section.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
