<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with('course', 'teacher')->paginate(15);
        return view('timetable.index', compact('timetables'));
    }

    public function create()
    {
        $courses = Course::where('status', 'Active')->get();
        $teachers = Teacher::where('status', 'Active')->get();
        return view('timetable.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_no' => 'required|string|max:20',
            'remarks' => 'nullable|string',
        ]);

        // Check for scheduling conflicts
        $conflict = Timetable::where('day', $validated['day'])
            ->where('room_no', $validated['room_no'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Room is already booked at this time!');
        }

        // Check teacher conflict
        $teacherConflict = Timetable::where('teacher_id', $validated['teacher_id'])
            ->where('day', $validated['day'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($teacherConflict) {
            return back()->with('error', 'Teacher has another class at this time!');
        }

        Timetable::create($validated);
        return redirect()->route('timetable.index')->with('success', 'Class scheduled successfully!');
    }

    public function show(Timetable $timetable)
    {
        $timetable->load('course', 'teacher');
        return view('timetable.show', compact('timetable'));
    }

    public function edit(Timetable $timetable)
    {
        $courses = Course::where('status', 'Active')->get();
        $teachers = Teacher::where('status', 'Active')->get();
        return view('timetable.edit', compact('timetable', 'courses', 'teachers'));
    }

    public function update(Request $request, Timetable $timetable)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_no' => 'required|string|max:20',
            'remarks' => 'nullable|string',
        ]);

        // Check for scheduling conflicts (excluding current timetable)
        $conflict = Timetable::where('day', $validated['day'])
            ->where('room_no', $validated['room_no'])
            ->where('id', '!=', $timetable->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Room is already booked at this time!');
        }

        // Check teacher conflict
        $teacherConflict = Timetable::where('teacher_id', $validated['teacher_id'])
            ->where('day', $validated['day'])
            ->where('id', '!=', $timetable->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->exists();

        if ($teacherConflict) {
            return back()->with('error', 'Teacher has another class at this time!');
        }

        $timetable->update($validated);
        return redirect()->route('timetable.show', $timetable)->with('success', 'Timetable updated successfully!');
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return redirect()->route('timetable.index')->with('success', 'Timetable entry deleted successfully!');
    }

    public function viewByDay(Request $request)
    {
        $day = $request->query('day', 'Monday');
        $timetables = Timetable::with('course', 'teacher')
            ->where('day', $day)
            ->orderBy('start_time')
            ->get();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('timetable.by-day', compact('timetables', 'day', 'days'));
    }

    public function viewByTeacher(Request $request)
    {
        $teachers = Teacher::where('status', 'Active')->get();
        $teacher_id = $request->query('teacher_id');
        
        // If no teacher is selected, show the first active teacher by default
        if (!$teacher_id && $teachers->count() > 0) {
            $teacher = $teachers->first();
            $teacher_id = $teacher->id;
        } elseif ($teacher_id) {
            $teacher = Teacher::findOrFail($teacher_id);
        } else {
            // No teachers found
            return view('timetable.by-teacher', [
                'teachers' => $teachers,
                'teacher' => null,
                'timetables' => collect()
            ]);
        }

        $timetables = Timetable::with('course')
            ->where('teacher_id', $teacher_id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        return view('timetable.by-teacher', compact('timetables', 'teacher', 'teachers'));
    }
}
