<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'suggested_major_id', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suggestedMajor()
    {
        return $this->belongsTo(Major::class, 'suggested_major_id');
    }
}
