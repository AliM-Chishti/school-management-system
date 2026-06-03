<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_no',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'parent_name',
        'parent_phone',
        'admission_status',
        'admission_date',
        'roll_number',
        'class_name',
        'remarks'
    ];

    protected $casts = [
        'admission_date' => 'date',
        'date_of_birth' => 'date',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id')
                    ->withPivot('enrollment_date', 'status')
                    ->withTimestamps();
    }

    public function timetables()
    {
        return $this->hasManyThrough(Timetable::class, Course::class, 'id', 'course_id', 'id', 'id');
    }
}
