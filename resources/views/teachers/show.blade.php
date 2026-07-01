@extends('layout.app')

@section('title', 'Teacher Details')
@section('page-title', $teacher->full_name)

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-primary text-white rounded-4 p-3 fs-3">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <h3 class="mb-1 fw-bold">{{ $teacher->full_name }}</h3>
                        <p class="text-muted mb-1">Employee #{{ $teacher->employee_id }}</p>
                        <span class="badge bg-success-subtle text-success">{{ $teacher->status }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-3">Contact details</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Email</span><strong>{{ $teacher->email }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Phone</span><strong>{{ $teacher->phone }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Gender</span><strong>{{ $teacher->gender }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">DOB</span><strong>{{ $teacher->date_of_birth->format('d M Y') }}</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Joining date</span><strong>{{ $teacher->joining_date->format('d M Y') }}</strong></li>
                    </ul>
                </div>

                <div>
                    <h6 class="text-uppercase text-muted small mb-3">Professional details</h6>
                    <div class="card rounded-4 border-0 bg-light p-3">
                        <p class="mb-2"><strong>{{ $teacher->qualification }}</strong></p>
                        <p class="mb-1 text-muted">Specialization: {{ $teacher->specialization }}</p>
                        <p class="mb-0 text-muted">{{ $teacher->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header d-flex justify-content-between align-items-center gap-3">
                <div>
                    <h5 class="mb-0">Assigned courses</h5>
                    <p class="text-muted mb-0">Track active course assignments and teaching load.</p>
                </div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal">
                    <i class="bi bi-plus-circle me-1"></i> Assign course
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Course</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Assigned</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teacher->courses as $course)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $course->course_name }}</div>
                                    <div class="text-muted small">{{ $course->course_code }}</div>
                                </td>
                                <td>{{ $course->department }}</td>
                                <td><span class="badge bg-info-subtle text-info">{{ $course->pivot->status }}</span></td>
                                <td>{{ $course->pivot->assigned_date->format('d M Y') }}</td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('teachers.remove-course', [$teacher, $course]) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this course?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No courses assigned yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
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
                    <h5 class="modal-title">Assign courses</h5>
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
@endsection
