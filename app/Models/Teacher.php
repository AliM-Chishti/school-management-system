<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'qualification',
        'specialization',
        'joining_date',
        'status',
        'remarks'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'date_of_birth' => 'date',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_teacher', 'teacher_id', 'course_id')
                    ->withPivot('assigned_date', 'status')
                    ->withTimestamps();
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}

