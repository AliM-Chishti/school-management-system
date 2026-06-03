@extends('layout.app')

@section('title', 'Student Details')
@section('page-title', $student->full_name)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-person-circle"></i> Student Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Enrollment No:</strong></td>
                        <td>{{ $student->enrollment_no }}</td>
                    </tr>
                    <tr>
                        <td><strong>Full Name:</strong></td>
                        <td>{{ $student->full_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $student->phone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong></td>
                        <td>{{ $student->gender }}</td>
                    </tr>
                    <tr>
                        <td><strong>DOB:</strong></td>
                        <td>{{ $student->date_of_birth->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($student->admission_status === 'Active')
                                <span class="badge badge-success">{{ $student->admission_status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $student->admission_status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-people-fill"></i> Parent/Guardian
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $student->parent_name }}</p>
                <p><strong>Phone:</strong> {{ $student->parent_phone }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-book-fill"></i> Enrolled Courses</span>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#enrollModal">
                    <i class="bi bi-plus-circle"></i> Enroll Course
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
                            <th>Enrollment Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($student->courses as $course)
                        <tr>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->department }}</td>
                            <td><span class="badge badge-info">{{ $course->pivot->status }}</span></td>
                            <td>{{ $course->pivot->enrollment_date->format('d M Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('students.drop-course', [$student, $course]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Drop this course?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No courses enrolled yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-credit-card-fill"></i> Fee Records
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Fee Amount</th>
                            <th>Due Date</th>
                            <th>Paid Amount</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                    <span class="badge badge-success">{{ $fee->payment_status }}</span>
                                @elseif($fee->payment_status === 'Partial')
                                    <span class="badge badge-warning">{{ $fee->payment_status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $fee->payment_status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('fees.show', $fee) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No fee records yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                    <h5 class="modal-title">Enroll in Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Course</label>
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

<div class="mt-3">
    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
    <a href="{{ route('students.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
@endsection
