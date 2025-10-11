<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorUniversity extends Model
{
    use HasFactory;

    protected $table = 'major_university';

    protected $fillable = ['major_id', 'university_id', 'tuition_fee', 'duration_years'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
