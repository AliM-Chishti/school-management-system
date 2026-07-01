@extends('layout.app')

@section('title', 'Student Details')
@section('page-title', $student->full_name)

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-primary text-white rounded-4 p-3 fs-3">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div>
                        <h3 class="mb-1 fw-bold">{{ $student->full_name }}</h3>
                        <p class="text-muted mb-1">Enrollment #{{ $student->enrollment_no }}</p>
                        <span class="badge bg-success-subtle text-success">{{ $student->admission_status }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-3">Personal details</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Email</span><strong>{{ $student->email }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Phone</span><strong>{{ $student->phone }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Gender</span><strong>{{ $student->gender }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Date of birth</span><strong>{{ $student->date_of_birth->format('d M Y') }}</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Admission date</span><strong>{{ $student->admission_date->format('d M Y') }}</strong></li>
                    </ul>
                </div>

                <div>
                    <h6 class="text-uppercase text-muted small mb-3">Parent / guardian</h6>
                    <div class="card rounded-4 border-0 bg-light p-3">
                        <p class="mb-2"><strong>{{ $student->parent_name }}</strong></p>
                        <p class="mb-0 text-muted">{{ $student->parent_phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header d-flex justify-content-between align-items-center gap-3">
                <div>
                    <h5 class="mb-0">Enrolled courses</h5>
                    <p class="text-muted mb-0">Active course assignments and statuses.</p>
                </div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#enrollModal">
                    <i class="bi bi-plus-circle me-1"></i> Enroll course
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Course</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Enrolled</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->courses as $course)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $course->course_name }}</div>
                                    <div class="text-muted small">{{ $course->course_code }}</div>
                                </td>
                                <td>{{ $course->department }}</td>
                                <td><span class="badge bg-info-subtle text-info">{{ $course->pivot->status }}</span></td>
                                <td>{{ $course->pivot->enrollment_date->format('d M Y') }}</td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('students.drop-course', [$student, $course]) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Drop this course?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No courses enrolled yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h5 class="mb-0">Fee records</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Amount</th>
                            <th>Due date</th>
                            <th>Paid</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->fees as $fee)
                            <tr>
                                <td>Rs. {{ number_format($fee->fee_amount, 0) }}</td>
                                <td>{{ $fee->due_date->format('d M Y') }}</td>
                                <td>Rs. {{ number_format($fee->paid_amount, 0) }}</td>
                                <td>
                                    @if($fee->payment_status === 'Paid')
                                        <span class="badge bg-success-subtle text-success">{{ $fee->payment_status }}</span>
                                    @elseif($fee->payment_status === 'Partial')
                                        <span class="badge bg-warning-subtle text-warning">{{ $fee->payment_status }}</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">{{ $fee->payment_status }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('fees.show', $fee) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No fee records yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
        </div>
    </div>
</div>

<!-- Enroll Modal -->
<div class="modal fade" id="enrollModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('students.enroll', $student) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Enroll in course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select course</label>
                        <select name="course_id" class="form-select" required>
                            <option value="">Choose a course...</option>
                            @foreach(\App\Models\Course::where('status', 'Active')->get() as $course)
                                @if(!$student->courses()->where('course_id', $course->id)->exists())
                                    <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enroll</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection