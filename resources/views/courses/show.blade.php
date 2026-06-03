@extends('layout.app')

@section('title', 'Course Details')
@section('page-title', $course->course_name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book-fill"></i> Course Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Code:</strong></td>
                        <td>{{ $course->course_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $course->course_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Department:</strong></td>
                        <td>{{ $course->department }}</td>
                    </tr>
                    <tr>
                        <td><strong>Credit Hours:</strong></td>
                        <td>{{ $course->credit_hours }}</td>
                    </tr>
                    <tr>
                        <td><strong>Max Students:</strong></td>
                        <td>{{ $course->max_students }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td><span class="badge badge-success">{{ $course->status }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="students-tab" data-bs-toggle="tab" data-bs-target="#students">Students ({{ $course->students->count() }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="teachers-tab" data-bs-toggle="tab" data-bs-target="#teachers">Teachers ({{ $course->teachers->count() }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule">Schedule ({{ $course->timetables->count() }})</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="students">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Enrolled Students</span>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#allocateStudents">
                            <i class="bi bi-plus-circle"></i> Allocate Students
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Enrollment No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Enrollment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->students as $student)
                                <tr>
                                    <td>{{ $student->enrollment_no }}</td>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->pivot->enrollment_date->format('d M Y') }}</td>
                                    <td><span class="badge badge-info">{{ $student->pivot->status }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No students enrolled yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="teachers">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Assigned Teachers</span>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#allocateTeachers">
                            <i class="bi bi-plus-circle"></i> Allocate Teachers
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Assigned Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->employee_id }}</td>
                                    <td>{{ $teacher->full_name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->pivot->assigned_date->format('d M Y') }}</td>
                                    <td><span class="badge badge-success">{{ $teacher->pivot->status }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No teachers assigned yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="schedule">
                <div class="card">
                    <div class="card-header">Class Schedule</div>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Teacher</th>
                                    <th>Room No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->timetables as $schedule)
                                <tr>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                    <td>{{ $schedule->teacher->full_name }}</td>
                                    <td>{{ $schedule->room_no }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No schedule created yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Allocate Students Modal -->
<div class="modal fade" id="allocateStudents" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('courses.allocate-students', $course) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Allocate Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Students (Hold Ctrl to select multiple)</label>
                        <select name="students[]" class="form-select" multiple required>
                            @foreach(\App\Models\Student::where('admission_status', 'Active')->get() as $student)
                            @if(!$course->students()->where('student_id', $student->id)->exists())
                            <option value="{{ $student->id }}">{{ $student->full_name }} ({{ $student->enrollment_no }})</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Allocate</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Allocate Teachers Modal -->
<div class="modal fade" id="allocateTeachers" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('courses.allocate-teachers', $course) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Allocate Teachers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Teachers (Hold Ctrl to select multiple)</label>
                        <select name="teachers[]" class="form-select" multiple required>
                            @foreach(\App\Models\Teacher::where('status', 'Active')->get() as $teacher)
                            @if(!$course->teachers()->where('teacher_id', $teacher->id)->exists())
                            <option value="{{ $teacher->id }}">{{ $teacher->full_name }} ({{ $teacher->employee_id }})</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Allocate</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
@endsection
