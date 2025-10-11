<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'website', 'ranking'];

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'major_university')
                    ->withPivot('tuition_fee', 'duration_years')
                    ->withTimestamps();
    }
}
