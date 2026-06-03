@extends('layout.app')

@section('title', 'Courses')
@section('page-title', 'Course Allocation Module')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book-fill"></i> Courses List</span>
        <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Course
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Department</th>
                    <th>Credit Hours</th>
                    <th>Students</th>
                    <th>Teachers</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td><strong>{{ $course->course_code }}</strong></td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->department }}</td>
                    <td>{{ $course->credit_hours }}</td>
                    <td><span class="badge badge-info">{{ $course->students_count }}</span></td>
                    <td><span class="badge badge-success">{{ $course->teachers_count }}</span></td>
                    <td>
                        @if($course->status === 'Active')
                            <span class="badge badge-success">{{ $course->status }}</span>
                        @else
                            <span class="badge badge-danger">{{ $course->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('courses.destroy', $course) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">No courses found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $courses->links() }}
</div>
@endsection
