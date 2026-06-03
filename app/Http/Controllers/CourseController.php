<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount(['students', 'teachers'])->paginate(15);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses',
            'course_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'department' => 'required|string|max:50',
            'credit_hours' => 'required|integer|min:1|max:10',
            'max_students' => 'required|integer|min:1|max:500',
            'syllabus' => 'nullable|string',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function show(Course $course)
    {
        $course->load('students', 'teachers', 'timetables');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'department' => 'required|string|max:50',
            'credit_hours' => 'required|integer|min:1|max:10',
            'max_students' => 'required|integer|min:1|max:500',
            'status' => 'required|in:Active,Inactive',
            'syllabus' => 'nullable|string',
        ]);

        $course->update($validated);
        return redirect()->route('courses.show', $course)->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    public function allocateToStudents(Request $request, Course $course)
    {
        $request->validate([
            'students' => 'required|array|min:1',
            'students.*' => 'exists:students,id',
        ]);

        foreach ($request->students as $student_id) {
            if (!$course->students()->where('student_id', $student_id)->exists()) {
                $course->students()->attach($student_id, [
                    'enrollment_date' => now(),
                    'status' => 'Enrolled'
                ]);
            }
        }

        return back()->with('success', 'Students allocated to course successfully!');
    }

    public function allocateToTeachers(Request $request, Course $course)
    {
        $request->validate([
            'teachers' => 'required|array|min:1',
            'teachers.*' => 'exists:teachers,id',
        ]);

        foreach ($request->teachers as $teacher_id) {
            if (!$course->teachers()->where('teacher_id', $teacher_id)->exists()) {
                $course->teachers()->attach($teacher_id, [
                    'assigned_date' => now(),
                    'status' => 'Active'
                ]);
            }
        }

        return back()->with('success', 'Teachers allocated to course successfully!');
    }
}
