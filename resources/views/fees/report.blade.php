@extends('layout.app')

@section('title', 'Fee Report')
@section('page-title', 'Financial Report')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card fees">
            <div class="stat-label">Total Fees</div>
            <div class="stat-value">Rs. {{ number_format($totalFees, 0) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="stat-label">Total Paid</div>
            <div class="stat-value text-success">Rs. {{ number_format($totalPaid, 0) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #f59e0b;">
            <div class="stat-label">Pending Amount</div>
            <div class="stat-value text-warning">Rs. {{ number_format($totalPending, 0) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-left-color: #3b82f6;">
            <div class="stat-label">Collection Rate</div>
            <div class="stat-value">{{ $totalFees > 0 ? round(($totalPaid / $totalFees) * 100, 1) : 0 }}%</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-bar-chart-fill"></i> Payment Status Summary
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Count</th>
                    <th>Total Amount</th>
                    <th>Percentage</th>
                    <th>Bar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentStatus as $status)
                <tr>
                    <td>
                        @if($status->payment_status === 'Paid')
                            <span class="badge badge-success">{{ $status->payment_status }}</span>
                        @elseif($status->payment_status === 'Partial')
                            <span class="badge badge-warning">{{ $status->payment_status }}</span>
                        @else
                            <span class="badge badge-danger">{{ $status->payment_status }}</span>
                        @endif
                    </td>
                    <td>{{ $status->total }}</td>
                    <td><strong>Rs. {{ number_format($status->total_amount, 0) }}</strong></td>
                    <td>{{ $totalFees > 0 ? round(($status->total_amount / $totalFees) * 100, 1) : 0 }}%</td>
                    <td>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: {{ $totalFees > 0 ? ($status->total_amount / $totalFees) * 100 : 0 }}%; 
                                @if($status->payment_status === 'Paid') background-color: #10b981; 
                                @elseif($status->payment_status === 'Partial') background-color: #f59e0b; 
                                @else background-color: #ef4444; @endif">
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('fees.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
@endsection
