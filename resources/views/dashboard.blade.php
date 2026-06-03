@extends('layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card students">
            <div class="stat-label">
                <i class="bi bi-people-fill"></i> Total Students
            </div>
            <div class="stat-value">{{ $totalStudents }}</div>
            <small class="text-muted">{{ $activeStudents }} Active</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card teachers">
            <div class="stat-label">
                <i class="bi bi-person-workspace"></i> Total Teachers
            </div>
            <div class="stat-value">{{ $totalTeachers }}</div>
            <small class="text-muted">{{ $activeTeachers }} Active</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card courses">
            <div class="stat-label">
                <i class="bi bi-book-fill"></i> Total Courses
            </div>
            <div class="stat-value">{{ $totalCourses }}</div>
            <small class="text-muted">{{ $activeCourses }} Active</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card fees">
            <div class="stat-label">
                <i class="bi bi-credit-card-fill"></i> Total Fees
            </div>
            <div class="stat-value">Rs. {{ number_format($totalFees, 0) }}</div>
            <small class="text-muted">Pending: Rs. {{ number_format($totalPending, 0) }}</small>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart-fill"></i> Payment Status
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Count</th>
                            <th>Amount</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feeStats as $stat)
                        <tr>
                            <td>
                                @if($stat->payment_status === 'Paid')
                                    <span class="badge badge-success">{{ $stat->payment_status }}</span>
                                @elseif($stat->payment_status === 'Partial')
                                    <span class="badge badge-warning">{{ $stat->payment_status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $stat->payment_status }}</span>
                                @endif
                            </td>
                            <td>{{ $stat->total }}</td>
                            <td>Rs. {{ number_format($stat->total_amount, 0) }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                        style="width: {{ ($stat->total_amount / $totalFees) * 100 }}%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-graph-up-arrow"></i> Financial Summary
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h5>Total Fees</h5>
                        <h3 class="text-primary">Rs. {{ number_format($totalFees, 0) }}</h3>
                    </div>
                    <div class="col-md-4">
                        <h5>Paid Amount</h5>
                        <h3 class="text-success">Rs. {{ number_format($totalPaid, 0) }}</h3>
                    </div>
                    <div class="col-md-4">
                        <h5>Pending</h5>
                        <h3 class="text-danger">Rs. {{ number_format($totalPending, 0) }}</h3>
                    </div>
                </div>
                <div class="mt-3">
                    <h6>Collection Rate</h6>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                            style="width: {{ $totalFees > 0 ? ($totalPaid / $totalFees) * 100 : 0 }}%">
                            {{ $totalFees > 0 ? round(($totalPaid / $totalFees) * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-plus-fill"></i> Recent Students
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentStudents as $student)
                        <tr>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                @if($student->admission_status === 'Active')
                                    <span class="badge badge-success">{{ $student->admission_status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $student->admission_status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No students yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-cash-coin"></i> Recent Fee Transactions
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentFees as $fee)
                        <tr>
                            <td>{{ $fee->student->full_name }}</td>
                            <td>Rs. {{ number_format($fee->fee_amount, 0) }}</td>
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
                                <a href="{{ route('fees.show', $fee) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No fee records yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
