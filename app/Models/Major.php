<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'requirements', 'career_opportunities'];

    public function universities()
    {
        return $this->belongsToMany(University::class, 'major_university')
                    ->withPivot('tuition_fee', 'duration_years')
                    ->withTimestamps();
    }

    public function surveyResults()
    {
        return $this->hasMany(SurveyResult::class, 'suggested_major_id');
    }

    public function careerPaths()
    {
        return $this->hasMany(CareerPath::class);
    }
}
