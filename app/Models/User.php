<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'is_blocked'];

    public function surveyResults()
    {
        return $this->hasMany(SurveyResult::class);
    }

    public function surveyAnswers()
    {
        return $this->hasMany(SurveyAnswer::class);
    }

    public function chatLogs()
    {
        return $this->hasMany(ChatLog::class);
    }

    public function adminLogs()
    {
        return $this->hasMany(AdminLog::class, 'admin_id');
    }
}
