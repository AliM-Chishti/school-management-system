<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('courses')->paginate(15);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|unique:teachers',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:teachers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'qualification' => 'required|string|max:100',
            'specialization' => 'required|string',
            'joining_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        Teacher::create($validated);
        return redirect()->route('teachers.index')->with('success', 'Teacher registered successfully!');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('courses', 'timetables');
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'employee_id' => 'required|unique:teachers,employee_id,' . $teacher->id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'qualification' => 'required|string|max:100',
            'specialization' => 'required|string',
            'joining_date' => 'required|date',
            'status' => 'required|in:Active,Inactive,On Leave',
            'remarks' => 'nullable|string',
        ]);

        $teacher->update($validated);
        return redirect()->route('teachers.show', $teacher)->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }

    public function assignCourse(Request $request, Teacher $teacher)
    {
        $course = Course::findOrFail($request->course_id);

        if ($teacher->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Teacher is already assigned to this course.');
        }

        $teacher->courses()->attach($course->id, [
            'assigned_date' => now(),
            'status' => 'Active'
        ]);

        return back()->with('success', 'Course assigned to teacher successfully!');
    }

    public function removeCourse(Teacher $teacher, Course $course)
    {
        $teacher->courses()->detach($course->id);
        return back()->with('success', 'Course removed from teacher successfully!');
    }
}

