<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $table = 'timetables';

    protected $fillable = [
        'course_id',
        'teacher_id',
        'day',
        'start_time',
        'end_time',
        'room_no',
        'remarks'
    ];

    protected $casts = [
        // Don't cast times as datetime, keep them as strings
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getDurationAttribute()
    {
        // Check if start_time and end_time exist and are not null
        if (!$this->start_time || !$this->end_time) {
            return 0;
        }

        try {
            $startStr = (string)$this->start_time;
            $endStr = (string)$this->end_time;

            // Handle both HH:MM:SS and HH:MM formats
            if (strlen($startStr) > 5) {
                // Format is HH:MM:SS, extract just HH:MM
                $startStr = substr($startStr, 0, 5);
            }
            if (strlen($endStr) > 5) {
                // Format is HH:MM:SS, extract just HH:MM
                $endStr = substr($endStr, 0, 5);
            }

            // Parse the times
            $start = \Carbon\Carbon::createFromFormat('H:i', $startStr);
            $end = \Carbon\Carbon::createFromFormat('H:i', $endStr);
            
            return $start->diffInMinutes($end);
        } catch (\Exception $e) {
            return 0;
        }
    }
}

