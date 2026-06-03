@extends('layout.app')

@section('title', 'Fees')
@section('page-title', 'Fee Management Module')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-credit-card-fill"></i> Fee Records</span>
        <div>
            <a href="{{ route('fees.create') }}" class="btn btn-primary btn-sm me-2">
                <i class="bi bi-plus-circle"></i> Add Fee
            </a>
            <a href="{{ route('fees.report') }}" class="btn btn-info btn-sm">
                <i class="bi bi-bar-chart"></i> View Report
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Fee Amount</th>
                    <th>Paid Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Collection %</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr>
                    <td>{{ $fee->student->full_name }}</td>
                    <td>Rs. {{ number_format($fee->fee_amount, 0) }}</td>
                    <td>Rs. {{ number_format($fee->paid_amount, 0) }}</td>
                    <td>{{ $fee->due_date->format('d M Y') }}</td>
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
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: {{ $fee->payment_percentage }}%">
                                {{ round($fee->payment_percentage, 1) }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('fees.show', $fee) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('fees.edit', $fee) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('fees.destroy', $fee) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No fee records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $fees->links() }}
</div>
@endsection
