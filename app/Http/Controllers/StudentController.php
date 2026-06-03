<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('fees', 'courses')->paginate(15);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'enrollment_no' => 'required|unique:students',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:students',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'parent_name' => 'required|string|max:100',
            'parent_phone' => 'required|string|max:15',
            'admission_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student admitted successfully!');
    }

    public function show(Student $student)
    {
        $student->load('fees', 'courses', 'courses.teachers');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'enrollment_no' => 'required|unique:students,enrollment_no,' . $student->id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'parent_name' => 'required|string|max:100',
            'parent_phone' => 'required|string|max:15',
            'admission_date' => 'required|date',
            'admission_status' => 'required|in:Active,Inactive,Suspended',
            'remarks' => 'nullable|string',
        ]);

        $student->update($validated);
        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function enrollCourse(Request $request, Student $student)
    {
        $course = Course::findOrFail($request->course_id);

        if ($student->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'Student is already enrolled in this course.');
        }

        if ($course->enrolledStudentsCount() >= $course->max_students) {
            return back()->with('error', 'Course is full. Cannot enroll more students.');
        }

        $student->courses()->attach($course->id, [
            'enrollment_date' => now(),
            'status' => 'Enrolled'
        ]);

        return back()->with('success', 'Student enrolled in course successfully!');
    }

    public function dropCourse(Student $student, Course $course)
    {
        $student->courses()->detach($course->id);
        return back()->with('success', 'Student dropped from course successfully!');
    }
}

