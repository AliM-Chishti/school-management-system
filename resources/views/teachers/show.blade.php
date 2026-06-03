@extends('layout.app')

@section('title', 'Teacher Details')
@section('page-title', $teacher->full_name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-person-circle"></i> Teacher Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Employee ID:</strong></td>
                        <td>{{ $teacher->employee_id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Full Name:</strong></td>
                        <td>{{ $teacher->full_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $teacher->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $teacher->phone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong></td>
                        <td>{{ $teacher->gender }}</td>
                    </tr>
                    <tr>
                        <td><strong>DOB:</strong></td>
                        <td>{{ $teacher->date_of_birth->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($teacher->status === 'Active')
                                <span class="badge badge-success">{{ $teacher->status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $teacher->status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-briefcase-fill"></i> Professional Details
            </div>
            <div class="card-body">
                <p><strong>Qualification:</strong> {{ $teacher->qualification }}</p>
                <p><strong>Specialization:</strong> {{ $teacher->specialization }}</p>
                <p><strong>Joining Date:</strong> {{ $teacher->joining_date->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-book-fill"></i> Assigned Courses</span>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal">
                    <i class="bi bi-plus-circle"></i> Assign Course
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Assigned Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teacher->courses as $course)
                        <tr>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->department }}</td>
                            <td><span class="badge badge-info">{{ $course->pivot->status }}</span></td>
                            <td>{{ $course->pivot->assigned_date->format('d M Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('teachers.remove-course', [$teacher, $course]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this course?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No courses assigned yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Assign Modal -->
<div class="modal fade" id="assignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('teachers.assign-courses', $teacher) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Assign Courses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Courses (Hold Ctrl to select multiple)</label>
                        <select name="courses[]" class="form-select" multiple required>
                            @foreach(\App\Models\Course::where('status', 'Active')->get() as $course)
                            @if(!$teacher->courses()->where('course_id', $course->id)->exists())
                            <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }})</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Assign</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
    <a href="{{ route('teachers.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
@endsection
