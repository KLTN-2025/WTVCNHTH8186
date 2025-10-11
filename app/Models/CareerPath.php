<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPath extends Model
{
    use HasFactory;

    protected $fillable = ['major_id', 'title', 'description', 'average_salary'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
