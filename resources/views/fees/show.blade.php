@extends('layout.app')

@section('title', 'Fee Details')
@section('page-title', 'Fee Record - ' . $fee->student->full_name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-file-text"></i> Fee Details
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Student Name:</strong></td>
                        <td>{{ $fee->student->full_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Enrollment No:</strong></td>
                        <td>{{ $fee->student->enrollment_no }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $fee->student->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fee Amount:</strong></td>
                        <td><span class="h5">Rs. {{ number_format($fee->fee_amount, 2) }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Due Date:</strong></td>
                        <td>{{ $fee->due_date->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Payment Status:</strong></td>
                        <td>
                            @if($fee->payment_status === 'Paid')
                                <span class="badge badge-success">{{ $fee->payment_status }}</span>
                            @elseif($fee->payment_status === 'Partial')
                                <span class="badge badge-warning">{{ $fee->payment_status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $fee->payment_status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-cash-coin"></i> Payment Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Paid Amount:</strong></td>
                        <td><span class="h5 text-success">Rs. {{ number_format($fee->paid_amount, 2) }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Remaining:</strong></td>
                        <td><span class="h5 text-danger">Rs. {{ number_format($fee->remaining_amount, 2) }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Collection %:</strong></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" 
                                    style="width: {{ $fee->payment_percentage }}%">
                                    {{ round($fee->payment_percentage, 1) }}%
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Payment Date:</strong></td>
                        <td>{{ $fee->payment_date ? $fee->payment_date->format('d M Y') : 'Not Paid' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td>{{ $fee->payment_method ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($fee->remaining_amount > 0)
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-plus-circle"></i> Record Payment
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('fees.record-payment', $fee) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Amount to Pay</label>
                        <input type="number" name="paid_amount" step="0.01" class="form-control @error('paid_amount') is-invalid @enderror" max="{{ $fee->remaining_amount }}" required>
                        @error('paid_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        <small class="text-muted">Maximum: Rs. {{ number_format($fee->remaining_amount, 2) }}</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Date</label>
                        <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" required>
                        @error('payment_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="">Select Method</option>
                            <option value="Cash">Cash</option>
                            <option value="Check">Check</option>
                            <option value="Online">Online Transfer</option>
                            <option value="Card">Credit/Debit Card</option>
                        </select>
                        @error('payment_method') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Record Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<div class="mt-3">
    <a href="{{ route('fees.generate-receipt', $fee) }}" class="btn btn-info"><i class="bi bi-file-pdf"></i> Download Receipt</a>
    <a href="{{ route('fees.edit', $fee) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
    <a href="{{ route('fees.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
@endsection
