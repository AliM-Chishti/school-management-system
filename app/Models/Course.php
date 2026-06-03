<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'department',
        'credit_hours',
        'max_students',
        'status',
        'syllabus'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id')
                    ->withPivot('enrollment_date', 'status')
                    ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher', 'course_id', 'teacher_id')
                    ->withPivot('assigned_date', 'status')
                    ->withTimestamps();
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function enrolledStudentsCount()
    {
        return $this->students()->wherePivot('status', 'Enrolled')->count();
    }
}
